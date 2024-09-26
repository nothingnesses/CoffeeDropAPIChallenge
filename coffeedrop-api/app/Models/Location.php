<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model {
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'postcode_id',
		'week_id',
	];

	public function postcode(): BelongsTo {
		return $this->belongsTo(Postcode::class);
	}

	public function week(): BelongsTo {
		return $this->belongsTo(Week::class);
	}
}
