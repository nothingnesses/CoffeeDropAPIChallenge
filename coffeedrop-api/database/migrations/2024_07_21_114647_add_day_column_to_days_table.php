<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::table('days', function (Blueprint $table) {
			$table
				->string('day', 9)
				->unique()
				->nullable(false);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::table('days', function (Blueprint $table) {
			$table->dropColumn('day');
		});
	}
};
