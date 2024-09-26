<?php

namespace App\Models;

use Clickbar\Magellan\Data\Geometries\Point;
use Clickbar\Magellan\Database\Eloquent\HasPostgisColumns;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JustSteveKing\LaravelPostcodes\Facades\Postcode as FacadesPostcode;

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

	protected function postcode(): Attribute {
		return Attribute::make(
			set: function ($value) {
				$postcode = FacadesPostcode::getPostcode($value);
				return [
					'postcode' => $value,
					'location' => Point::makeGeodetic(
						latitude: $postcode->latitude,
						longitude: $postcode->longitude
					),
				];
			}
		);
	}
}
