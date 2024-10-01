<?php

namespace App\Http\Resources;

use App\Services\HelperService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CashbackResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array {
		$total = HelperService::division_with_remainder($this->total, 100);
		$total = [
			'pounds' => $total[0],
			'pence' => $total[1],
		];
		return match ($request->method()) {
			'GET' => [
				'user_id' => $this->user_id,
				'total' => $total,
				'products' => $this
					->products
					->map(
						fn($product) => [
							'name' => $product->name,
							'amount' => $product->pivot->amount
						]
					)
			],
			'POST' => ['total' => $total],
			default => [],
		};
	}
}
