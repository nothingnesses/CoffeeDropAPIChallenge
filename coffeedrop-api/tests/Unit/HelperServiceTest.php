<?php

namespace Tests\Unit;

use App\Services\HelperService;
use PHPUnit\Framework\TestCase;

class HelperServiceTest extends TestCase {
	public function test_inverse_division_with_remainder(): void {
		$inverse = fn($divisor, $quotient, $remainder) => $quotient * $divisor + $remainder;
		foreach (
			collect()
				->range(0, 999)
				->map(
					function () {
						while (true) {
							$result = (lcg_value() / 100) * 100;
							if ($result > 0) {
								return $result;
							}
						}
					}
				) as $item
		) {
			$this->assertTrue($inverse(100, ...HelperService::division_with_remainder($item, 100)) === $item, $item);
		}
	}
}
