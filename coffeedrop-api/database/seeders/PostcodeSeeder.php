<?php

namespace Database\Seeders;

use App\Imports\PostcodesImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class PostcodeSeeder extends Seeder {
	use WithoutModelEvents;

	/**
	 * Run the database seeds.
	 */
	public function run(): void {
		Excel::import(new PostcodesImport, public_path('location_data.csv'));
	}
}
