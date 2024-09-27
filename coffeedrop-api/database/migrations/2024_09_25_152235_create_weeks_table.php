<?php

use App\Models\Day;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('weeks', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table
				->foreignIdFor(Day::class, 'day_' . Carbon::SUNDAY)
				->nullable()
				->constrained('days')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->foreignIdFor(Day::class, 'day_' . Carbon::MONDAY)
				->nullable()
				->constrained('days')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->foreignIdFor(Day::class, 'day_' . Carbon::TUESDAY)
				->nullable()
				->constrained('days')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->foreignIdFor(Day::class, 'day_' . Carbon::WEDNESDAY)
				->nullable()
				->constrained('days')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->foreignIdFor(Day::class, 'day_' . Carbon::THURSDAY)
				->nullable()
				->constrained('days')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->foreignIdFor(Day::class, 'day_' . Carbon::FRIDAY)
				->nullable()
				->constrained('days')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->foreignIdFor(Day::class, 'day_' . Carbon::SATURDAY)
				->nullable()
				->constrained('days')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table->unique([
				'day_' . Carbon::SUNDAY,
				'day_' . Carbon::MONDAY,
				'day_' . Carbon::TUESDAY,
				'day_' . Carbon::WEDNESDAY,
				'day_' . Carbon::THURSDAY,
				'day_' . Carbon::FRIDAY,
				'day_' . Carbon::SATURDAY
			]);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('weeks');
	}
};
