<?php

namespace Database\Seeders;

use App\Imports\BusinessHoursImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class BusinessHoursSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 */
	public function run(): void {
		Excel::import(new BusinessHoursImport, public_path('location_data.csv'));
	}
}
