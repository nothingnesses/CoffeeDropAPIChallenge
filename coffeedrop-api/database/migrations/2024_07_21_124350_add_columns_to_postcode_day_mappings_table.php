<?php

use App\Models\Day;
use App\Models\Postcode;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::table('postcode_day_mappings', function (Blueprint $table) {
			$table
				->foreignIdFor(Postcode::class, 'postcode_id')
				->nullable(false)
				->constrained()
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->foreignIdFor(Day::class, 'day_id')
				->nullable(false)
				->constrained()
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table->unique([
				'postcode_id',
				'day_id'
			]);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::table('postcode_day_mappings', function (Blueprint $table) {
			$table->dropConstrainedForeignIdFor(Day::class);
			$table->dropConstrainedForeignIdFor(Postcode::class);
		});
	}
};
