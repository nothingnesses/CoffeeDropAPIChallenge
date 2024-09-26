<?php

namespace App\Models;

use Clickbar\Magellan\Database\Eloquent\HasPostgisColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Postcode extends Model {
	use HasFactory, HasPostgisColumns;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = ['postcode'];

	protected array $postgisColumns = [
		'location' => [
			'type' => 'geography',
			'srid' => 4326,
		],
	];

	public function location(): HasMany {
		return $this->hasMany(Location::class);
	}
}
