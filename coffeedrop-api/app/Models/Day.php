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
		return $this->belongsTo(Time::class, 'open_time_id');
	}

	public function closing_time(): BelongsTo {
		return $this->belongsTo(Time::class, 'closed_time_id');
	}

	public function as_sunday(): HasMany {
		return $this->hasMany(Week::class, 'day_' . Carbon::SUNDAY);
	}

	public function as_monday(): HasMany {
		return $this->hasMany(Week::class, 'day_' . Carbon::MONDAY);
	}

	public function as_tuesday(): HasMany {
		return $this->hasMany(Week::class, 'day_' . Carbon::TUESDAY);
	}

	public function as_wednesday(): HasMany {
		return $this->hasMany(Week::class, 'day_' . Carbon::WEDNESDAY);
	}

	public function as_thursday(): HasMany {
		return $this->hasMany(Week::class, 'day_' . Carbon::THURSDAY);
	}

	public function as_friday(): HasMany {
		return $this->hasMany(Week::class, 'day_' . Carbon::FRIDAY);
	}

	public function as_saturday(): HasMany {
		return $this->hasMany(Week::class, 'day_' . Carbon::SATURDAY);
	}
}
