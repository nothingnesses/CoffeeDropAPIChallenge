<?php

use App\Models\PostcodeDayMapping;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::table('locations', function (Blueprint $table) {
			$table
				->foreignIdFor(PostcodeDayMapping::class)
				->unique()
				->nullable(false)
				->constrained()
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->unsignedBigInteger('opening_time_id')
				->nullable();
			$table
				->foreign('opening_time_id')
				->references('id')
				->on('times')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->unsignedBigInteger('closing_time_id')
				->nullable();
			$table
				->foreign('closing_time_id')
				->references('id')
				->on('times')
				->cascadeOnUpdate()
				->cascadeOnDelete();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::table('locations', function (Blueprint $table) {
			$table->dropColumn('closing_time_id');
			$table->dropColumn('opening_time_id');
			$table->dropConstrainedForeignIdFor(PostcodeDayMapping::class);
		});
	}
};
