<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JustSteveKing\LaravelPostcodes\Facades\Postcode as FacadesPostcode;

class Postcode extends Model {
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = ['postcode'];

	protected function postcode(): Attribute {
		return Attribute::make(set: function ($value) {
			$postcode_data = FacadesPostcode::getPostcode($value);
			return [
				'postcode' => $value,
				'latitude' => $postcode_data->latitude,
				'longitude' => $postcode_data->longitude,
			];
		});
	}

	public function business_hours(): HasMany {
		return $this->hasMany(BusinessHours::class);
	}
}
