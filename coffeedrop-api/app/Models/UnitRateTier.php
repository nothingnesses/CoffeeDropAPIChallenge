<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnitRateTier extends Model {
	use HasFactory;

	public function as_tier_below(): HasMany {
		return $this->hasMany(Self::class);
	}

	public function product(): HasMany {
		return $this->hasMany(Product::class);
	}

	public function tier_below(): BelongsTo {
		return $this->belongsTo(Self::class);
	}
}
