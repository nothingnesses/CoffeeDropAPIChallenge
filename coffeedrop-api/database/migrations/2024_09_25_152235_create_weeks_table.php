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
				->foreignIdFor(Day::class, 'day_' . Carbon::SUNDAY . '_id')
				->nullable()
				->constrained('days')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->foreignIdFor(Day::class, 'day_' . Carbon::MONDAY . '_id')
				->nullable()
				->constrained('days')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->foreignIdFor(Day::class, 'day_' . Carbon::TUESDAY . '_id')
				->nullable()
				->constrained('days')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->foreignIdFor(Day::class, 'day_' . Carbon::WEDNESDAY . '_id')
				->nullable()
				->constrained('days')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->foreignIdFor(Day::class, 'day_' . Carbon::THURSDAY . '_id')
				->nullable()
				->constrained('days')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->foreignIdFor(Day::class, 'day_' . Carbon::FRIDAY . '_id')
				->nullable()
				->constrained('days')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table
				->foreignIdFor(Day::class, 'day_' . Carbon::SATURDAY . '_id')
				->nullable()
				->constrained('days')
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table->unique([
				'day_' . Carbon::SUNDAY . '_id',
				'day_' . Carbon::MONDAY . '_id',
				'day_' . Carbon::TUESDAY . '_id',
				'day_' . Carbon::WEDNESDAY . '_id',
				'day_' . Carbon::THURSDAY . '_id',
				'day_' . Carbon::FRIDAY . '_id',
				'day_' . Carbon::SATURDAY . '_id',
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
