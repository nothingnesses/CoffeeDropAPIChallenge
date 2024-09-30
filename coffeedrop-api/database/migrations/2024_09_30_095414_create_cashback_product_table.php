<?php

use App\Models\Cashback;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('cashback_product', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table
				->foreignIdFor(Cashback::class)
				->nullable(false)
				->constrained()
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->foreignIdFor(Product::class)
				->nullable(false)
				->constrained()
				->cascadeOnUpdate()
				->cascadeOnDelete();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('cashback_product');
	}
};
