<?php declare(strict_types=1);

namespace Helpers {
	class Coordinates {
		public function __construct(public float $latitude, public float $longitude) {}
	}

	/**
	 * Use the haversine formula to calculate the spherical distance, in metres, between two coordinates on a sphere.
	 * @param \Helpers\Coordinates $first The first set of coordinates.
	 * @param \Helpers\Coordinates $second The second set of coordinates.
	 * @param float $radius The radius of the sphere in metres. Defaults to the mean radius of Earth.
	 */
	function get_spherical_distance(Coordinates $first, Coordinates $second, $radius = 6371008.7714) {
		$first = new Coordinates(deg2rad($first->latitude), deg2rad($first->longitude));
		$second = new Coordinates(deg2rad($second->latitude), deg2rad($second->longitude));
		return 2
			* $radius
			* asin(
				sqrt(
					pow(
						sin(($second->latitude - $first->latitude) / 2),
						2
					)
					+ cos($first->latitude)
					* cos($second->latitude)
					* pow(
						sin(($second->longitude - $first->longitude) / 2),
						2
					)
				)
			);
	}

	function separate_decimal(float $decimal): array {
		$integer = floor($decimal);
		return [
			'integer' => $integer,
			'fraction' => $decimal - $integer
		];
	}

	function pence_to_pounds_and_pence(float $pence): array {
		$pounds = $pence / 100;
		$parts = separate_decimal($pounds);
		return [
			'pounds' => $parts['integer'],
			'pence' => round($parts['fraction'] * 100),
		];
	}
}
