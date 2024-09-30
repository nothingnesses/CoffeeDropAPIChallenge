<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('cashbacks', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table
				->foreignIdFor(User::class)
				->nullable(true)
				->constrained()
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->integer('total', unsigned: true)
				->nullable(false);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('cashbacks');
	}
};
