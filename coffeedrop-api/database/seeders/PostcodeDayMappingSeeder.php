<?php

namespace Database\Seeders;

use App\Imports\PostcodeDayMappingsImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class PostcodeDayMappingSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 */
	public function run(): void {
		Excel::import(new PostcodeDayMappingsImport, public_path('location_data.csv'));
	}
}
