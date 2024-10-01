<?php

namespace App\Services;

class HelperService {
	public static function division_with_remainder($dividend, $divisor): array {
		$remainder = (($dividend % $divisor) + abs($divisor)) % abs($divisor);
		return [
			($dividend - $remainder) / $divisor,
			$remainder
		];
	}
}
