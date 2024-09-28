<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array {
		$output = ['postcode' => $this->postcode];
		$now = Carbon::now();
		foreach (
			[
				Carbon::SUNDAY,
				Carbon::MONDAY,
				Carbon::TUESDAY,
				Carbon::WEDNESDAY,
				Carbon::THURSDAY,
				Carbon::FRIDAY,
				Carbon::SATURDAY
			] as $day
		) {
			$day_name = strtolower(
				$now
					->next($day)
					->dayName
			);
			if (!empty($this["opening_time_{$day_name}"]) && !empty($this["closing_time_{$day_name}"])) {
				$output['opening_times'][$day_name] = $this["opening_time_{$day_name}"];
				$output['closing_times'][$day_name] = $this["closing_time_{$day_name}"];
			}
		}
		return $output;
	}
}
