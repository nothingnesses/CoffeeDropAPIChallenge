<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaySeeder extends Seeder {
	/**
	 * Run the database seeds.
	 */
	public function run(): void {
		DB::table('days')->updateOrInsert(['day' => 'Monday']);
		DB::table('days')->updateOrInsert(['day' => 'Tuesday']);
		DB::table('days')->updateOrInsert(['day' => 'Wednesday']);
		DB::table('days')->updateOrInsert(['day' => 'Thursday']);
		DB::table('days')->updateOrInsert(['day' => 'Friday']);
		DB::table('days')->updateOrInsert(['day' => 'Saturday']);
		DB::table('days')->updateOrInsert(['day' => 'Sunday']);
	}
}
