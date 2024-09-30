<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashbackRequest;
use App\Http\Resources\CashbackResource;
use App\Models\Cashback;
use App\Models\Product;
use App\Models\User;

class CashbackController extends Controller {
	/**
	 * Store a newly created resource in storage.
	 */
	public function store(CashbackRequest $request) {
		$total = 0;
		foreach ($request->collect() as $product => $amount) {
			$amount_remaining = $amount;
			foreach (
				Product::firstWhere('name', $product)
					->unit_rate_tiers
					->sortByDesc('minimum_amount') as $current_tier
			) {
				if ($amount_remaining <= 0)
					break;
				if ($amount_remaining >= $current_tier->minimum_amount) {
					$amount_this_tier = $amount_remaining - $current_tier->minimum_amount;
					$total += $amount_this_tier * $current_tier->rate;
					$amount_remaining -= $amount_this_tier;
				}
			}
		}
		$cashback = Cashback::create([
			'user_id' => optional(
				auth('api')->user(),
				fn(User $user) => $user->getKey()
			),
			'total' => $total
		]);
		$cashback
			->products()
			->sync(
				Product::whereIn(
					'name',
					$request
						->collect()
						->keys()
				)
					->get()
					->mapWithKeys(
						fn($product) => [
							$product->getKey() => [
								'amount' => $request->input($product->name)
							]
						]
					)
			);
		return CashbackResource::make($cashback);
	}
}
