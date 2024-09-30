<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Day extends Model {
	use HasFactory;

	public function opening_time(): BelongsTo {
		return $this->belongsTo(Time::class, 'opening_time_id');
	}

	public function closing_time(): BelongsTo {
		return $this->belongsTo(Time::class, 'closing_time_id');
	}

	public function as_sunday(): HasMany {
		return $this->hasMany(Week::class, 'day_' . Carbon::SUNDAY . '_id');
	}

	public function as_monday(): HasMany {
		return $this->hasMany(Week::class, 'day_' . Carbon::MONDAY . '_id');
	}

	public function as_tuesday(): HasMany {
		return $this->hasMany(Week::class, 'day_' . Carbon::TUESDAY . '_id');
	}

	public function as_wednesday(): HasMany {
		return $this->hasMany(Week::class, 'day_' . Carbon::WEDNESDAY . '_id');
	}

	public function as_thursday(): HasMany {
		return $this->hasMany(Week::class, 'day_' . Carbon::THURSDAY . '_id');
	}

	public function as_friday(): HasMany {
		return $this->hasMany(Week::class, 'day_' . Carbon::FRIDAY . '_id');
	}

	public function as_saturday(): HasMany {
		return $this->hasMany(Week::class, 'day_' . Carbon::SATURDAY . '_id');
	}
}
