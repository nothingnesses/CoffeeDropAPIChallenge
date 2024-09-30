<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\UnitRateTier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder {
	use WithoutModelEvents;

	/**
	 * Run the database seeds.
	 */
	public function run(): void {
		foreach (
			[
				['Ristretto', 2, 3, 5],
				['Espresso', 4, 6, 10],
				['Lungo', 6, 9, 15]
			] as [$name, $first, $second, $third]
		) {
			Product::firstOrCreate(['name' => $name])
				->unit_rate_tiers()
				->saveMany(
					[
						UnitRateTier::firstOrCreate([
							'minimum_amount' => 500,
							'rate' => $third
						]),
						UnitRateTier::firstOrCreate([
							'minimum_amount' => 50,
							'rate' => $second
						]),
						UnitRateTier::firstOrCreate([
							'minimum_amount' => 0,
							'rate' => $first
						])
					]
				);
		}
	}
}
