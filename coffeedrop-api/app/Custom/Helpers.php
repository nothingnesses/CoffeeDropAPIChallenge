<?php

namespace App\Custom;

class Helpers {
	public static function separate_decimal(float $decimal): array {
		$integer = floor($decimal);
		return [
			'integer' => $integer,
			'fraction' => $decimal - $integer
		];
	}

	public static function pence_to_pounds_and_pence(float $pence): array {
		$pounds = $pence / 100;
		$parts = Self::separate_decimal($pounds);
		return [
			'pounds' => $parts['integer'],
			'pence' => round($parts['fraction'] * 100),
		];
	}
}