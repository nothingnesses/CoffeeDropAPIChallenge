<?php

namespace App\Http\Resources;

use App\Custom\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CashbackResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array {
		return match ($request->method()) {
			'GET' => parent::toArray($request),
			'POST' => Helpers::pence_to_pounds_and_pence($this->total),
			default => [],
		};
	}
}
