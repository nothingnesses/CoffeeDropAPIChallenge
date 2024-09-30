<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model {
	use HasFactory;

	public function cashbacks(): BelongsToMany {
		return $this
			->belongsToMany(Cashback::class)
			->withPivot('amount');
	}

	public function unit_rate_tiers(): BelongsToMany {
		return $this->belongsToMany(UnitRateTier::class);
	}
}
