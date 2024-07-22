<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::table('cashbacks', function (Blueprint $table) {
			$table
				->unsignedInteger('ristretto')
				->default(0)
				->nullable(false);
			$table
				->unsignedInteger('espresso')
				->default(0)
				->nullable(false);
			$table
				->unsignedInteger('lungo')
				->default(0)
				->nullable(false);
			$table
				->unsignedInteger('cashback_pounds')
				->default(0)
				->nullable(false);
			$table
				->unsignedInteger('cashback_pence')
				->default(0)
				->nullable(false);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::table('cashbacks', function (Blueprint $table) {
			$table->dropColumn('cashback_pence');
			$table->dropColumn('cashback_pounds');
			$table->dropColumn('lungo');
			$table->dropColumn('espresso');
			$table->dropColumn('ristretto');
		});
	}
};
