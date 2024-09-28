<?php

namespace App\Http\Requests;

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
			default => []
		};
	}
}
