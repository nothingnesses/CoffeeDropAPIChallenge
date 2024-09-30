<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 */
	public function run(): void {
		$this->call([
			UserSeeder::class,
			TimeSeeder::class,
			DaySeeder::class,
			WeekSeeder::class,
			PostcodeSeeder::class,
			LocationSeeder::class,
			UnitRateTierSeeder::class,
			ProductSeeder::class
		]);
	}
}
