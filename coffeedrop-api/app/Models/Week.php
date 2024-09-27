<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Week extends Model {
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'day_' . Carbon::SUNDAY . '_id',
		'day_' . Carbon::MONDAY . '_id',
		'day_' . Carbon::TUESDAY . '_id',
		'day_' . Carbon::WEDNESDAY . '_id',
		'day_' . Carbon::THURSDAY . '_id',
		'day_' . Carbon::FRIDAY . '_id',
		'day_' . Carbon::SATURDAY . '_id',
	];

	public function location(): HasMany {
		return $this->hasMany(Location::class);
	}

	public function sunday(): BelongsTo {
		return $this->belongsTo(Day::class, 'day_' . Carbon::SUNDAY . '_id');
	}

	public function monday(): BelongsTo {
		return $this->belongsTo(Day::class, 'day_' . Carbon::MONDAY . '_id');
	}

	public function tuesday(): BelongsTo {
		return $this->belongsTo(Day::class, 'day_' . Carbon::TUESDAY . '_id');
	}

	public function wednesday(): BelongsTo {
		return $this->belongsTo(Day::class, 'day_' . Carbon::WEDNESDAY . '_id');
	}

	public function thursday(): BelongsTo {
		return $this->belongsTo(Day::class, 'day_' . Carbon::THURSDAY . '_id');
	}

	public function friday(): BelongsTo {
		return $this->belongsTo(Day::class, 'day_' . Carbon::FRIDAY . '_id');
	}

	public function saturday(): BelongsTo {
		return $this->belongsTo(Day::class, 'day_' . Carbon::SATURDAY . '_id');
	}
}
