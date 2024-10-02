<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class CashbackRequest extends FormRequest {
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
				$this->query('latest'),
				fn($n) => $this->merge([
					'latest' => $n,
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
				'latest' => [
					'nullable',
					'integer',
					'numeric',
					'gte:0'
				]
			],
			'POST' => Product::pluck('name')
				->map(
					fn($product) => [
						$product => [
							'nullable',
							'integer',
							'numeric',
							'gte:0'
						]
					]
				)
				->all(),
			default => []
		};
	}
}
