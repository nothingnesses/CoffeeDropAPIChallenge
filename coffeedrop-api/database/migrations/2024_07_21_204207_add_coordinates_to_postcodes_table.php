<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::table('postcodes', function (Blueprint $table) {
			$table
				->decimal('latitude', total: 10, places: 6)
				->nullable(false);
			$table
				->decimal('longitude', total: 10, places: 6)
				->nullable(false);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::table('postcodes', function (Blueprint $table) {
			$table->dropColumn('longitude');
			$table->dropColumn('latitude');
		});
	}
};
