<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashbackRequest;
use App\Http\Resources\CashbackResource;
use App\Models\Cashback;
use App\Models\Product;

class CashbackController extends Controller {
	/**
	 * Store a newly created resource in storage.
	 */
	public function store(CashbackRequest $request) {
		$total = 0;
		foreach ($request->collect() as $product => $amount) {
			$amount_remaining = $amount;
			$current_tier = Product::firstWhere('name', $product)->unit_rate_tier;
			while (!empty($current_tier) && $amount_remaining > 0) {
				if ($amount_remaining >= $current_tier->minimum_amount) {
					$amount_this_tier = $amount_remaining - $current_tier->minimum_amount;
					$total += $amount_this_tier * $current_tier->rate;
					$amount_remaining -= $amount_this_tier;
				}
				$current_tier = $current_tier->tier_below;
			}
		}
		$cashback = Cashback::create([
			'user_id' => optional($request->user(), fn($user) => $user->getKey()),
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
					->map(fn($product) => $product->getKey())
			);
		return new CashbackResource($cashback);
	}
}
