<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model {
	use HasFactory;

	public function cashbacks(): BelongsToMany {
		return $this->belongsToMany(Cashback::class);
	}

	public function unit_rate_tier(): BelongsTo {
		return $this->belongsTo(UnitRateTier::class);
	}
}
