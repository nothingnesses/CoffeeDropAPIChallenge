<?php

use App\Models\UnitRateTier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('unit_rate_tiers', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table
				->integer('minimum_amount', unsigned: true)
				->nullable(false);
			$table
				->integer('rate', unsigned: true)
				->nullable(false);
			$table
				->foreignIdFor(UnitRateTier::class, 'tier_below_id')
				->nullable()
				->constrained('unit_rate_tiers')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table->unique([
				'minimum_amount',
				'rate',
				'tier_below_id'
			]);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('unit_rate_tiers');
	}
};
