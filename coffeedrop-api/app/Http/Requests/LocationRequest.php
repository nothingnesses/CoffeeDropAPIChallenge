<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocationRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool {
		return true;
	}

	/**
	 * Prepare the data for validation.
	 */
	protected function prepareForValidation(): void {
		match ($this->method()) {
			'GET' => optional(
				$this->query('nearest-to-postcode'),
				fn($postcode_parameter) => $this->merge([
					'nearest-to-postcode' => $postcode_parameter,
				])
			),
			default => null,
		};
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array {
		return match ($this->method()) {
			'GET' => [
				'nearest-to-postcode' => [
					'string',
					Rule::postcode()
				]
			],
			'POST' => (
				function () {
					$now = Carbon::now();
					$rules = [
						'postcode' => [
							'required',
							'string',
							Rule::postcode()
						],
						'opening_times' => ['required'],
						'closing_times' => ['required'],
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
						$rules["opening_times.{$day_name}"] = ['date_format:H:i'];
						$rules["closing_times.{$day_name}"] = ['date_format:H:i'];
					}
					return $rules;
				}
			)(),
			default => []
		};
	}
}
