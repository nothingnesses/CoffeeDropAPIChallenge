<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cashback extends Model {
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = ['user_id', 'total'];

	public function products(): BelongsToMany {
		return $this->belongsToMany(Product::class);
	}

	public function user(): BelongsTo {
		return $this->belongsTo(User::class);
	}
}
