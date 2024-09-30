<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Time extends Model {
	use HasFactory;

	public function as_opening_time(): HasMany {
		return $this->hasMany(Day::class, 'open_time_id');
	}

	public function as_closing_time(): HasMany {
		return $this->hasMany(Day::class, 'closed_time_id');
	}
}
