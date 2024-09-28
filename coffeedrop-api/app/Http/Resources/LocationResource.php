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
		$now = Carbon::now();
		$format_time = fn($time) => Carbon::createFromTimeString($time)->format('H:i');
		$result = [
			'postcode' => $this
				->postcode
				->postcode
		];
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
			if (!empty($this
					->week
					->$day_name)) {
				$result['opening_times'][$day_name] = $format_time(
					$this
						->week
						->$day_name
						->opening_time
						->time
				);
				$result['closing_times'][$day_name] = $format_time(
					$this
						->week
						->$day_name
						->closing_time
						->time
				);
			}
		}
		return $result;
	}
}
