<?php

namespace Database\Seeders;

use App\Models\UnitRateTier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitRateTierSeeder extends Seeder {
	use WithoutModelEvents;

	/**
	 * Run the database seeds.
	 */
	public function run(): void {
		foreach (
			[
				[2, 3, 5],
				[4, 6, 10],
				[6, 9, 15]
			] as [$first, $second, $third]
		) {
			UnitRateTier::firstOrCreate([
				'minimum_amount' => 500,
				'rate' => $third,
				'tier_below_id' => UnitRateTier::firstOrCreate([
					'minimum_amount' => 50,
					'rate' => $second,
					'tier_below_id' => UnitRateTier::firstOrCreate([
						'minimum_amount' => 0,
						'rate' => $first,
						'tier_below_id' => null
					])->getKey()
				])->getKey()
			]);
		}
	}
}
