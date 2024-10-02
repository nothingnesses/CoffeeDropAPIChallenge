<?php

use App\Models\Product;
use App\Models\UnitRateTier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('product_unit_rate_tier', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table
				->foreignIdFor(Product::class)
				->nullable(false)
				->constrained()
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->foreignIdFor(UnitRateTier::class)
				->nullable(false)
				->constrained()
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table->unique([
				'product_id',
				'unit_rate_tier_id'
			]);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('product_unit_rate_tier');
	}
};
