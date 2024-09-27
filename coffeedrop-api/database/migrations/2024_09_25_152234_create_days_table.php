<?php

use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('days', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table
				->enum(
					'day',
					[
						Carbon::SUNDAY,
						Carbon::MONDAY,
						Carbon::TUESDAY,
						Carbon::WEDNESDAY,
						Carbon::THURSDAY,
						Carbon::FRIDAY,
						Carbon::SATURDAY,
					]
				)
				->nullable(false);
			$table
				->foreignIdFor(Time::class, 'opening_time_id')
				->constrained('times')
				->nullable(false)
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->foreignIdFor(Time::class, 'closing_time_id')
				->constrained('times')
				->nullable(false)
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table->unique([
				'day',
				'opening_time_id',
				'closing_time_id',
			]);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('days');
	}
};
