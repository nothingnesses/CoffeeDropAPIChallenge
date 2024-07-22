<?php

namespace App\Http\Controllers;

use App\Models\Cashback;
use Illuminate\Http\Request;

class CashbackController extends Controller {
	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Cashback $cashback) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Cashback $cashback) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Cashback $cashback) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Cashback $cashback) {
		//
	}

	/**
	 * Accepts a quantity of each of the three sizes of used coffee pods as raw post data and returns the amount in pounds and pence that the client will receive in cashback.
	 *
	 * @param Request $request The request containing the JSON-formatted body.
	 * @todo Add validation, sanitisation and error-reporting.
	 */
	public function calculate_cashback(Request $request) {
		$rules = [
			'Ristretto' => [50 => 2, 500 => 3, 'default' => 5],
			'Espresso' => [50 => 4, 500 => 6, 'default' => 10],
			'Lungo' => [50 => 6, 500 => 9, 'default' => 15],
		];
		$request_parsed = $request->json()->all();
		$cashback = \Helpers\pence_to_pounds_and_pence(collect($request_parsed)
			->map(
				fn($item, $key) => (isset($rules[$key]) && is_array($rules[$key]))
					? collect($rules[$key])
						->reduce(
							function ($carry, $price_per, $limit) {
								if ($limit === 'default') {
									return [
										'total' => $carry['total'] + $carry['remaining'] * $price_per,
										'remaining' => 0
									];
								} else {
									$max_taken = $limit - $carry['from'];
									$taken = min($carry['remaining'], $max_taken);
									return [
										'from' => $limit,
										'total' => $carry['total'] + $taken * $price_per,
										'remaining' => $carry['remaining'] - $taken
									];
								}
							},
							[
								'from' => 0,
								'total' => 0,
								'remaining' => $item
							]
						)['total']
					: 0
			)
			->sum());
		return Cashback::create([
			'ristretto' => $request_parsed['Ristretto'],
			'espresso' => $request_parsed['Espresso'],
			'lungo' => $request_parsed['Lungo'],
			'cashback_pounds' => $cashback['pounds'],
			'cashback_pence' => $cashback['pence'],
		])
			->fresh()
			->only([
				'cashback_pounds',
				'cashback_pence',
			]);
	}
}
