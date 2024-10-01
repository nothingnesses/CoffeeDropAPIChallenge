<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @property int $total
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Cashback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cashback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cashback query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cashback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cashback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cashback whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cashback whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cashback whereUserId($value)
 */
	class Cashback extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $day
 * @property int $open_time_id
 * @property int $closed_time_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Week> $as_friday
 * @property-read int|null $as_friday_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Week> $as_monday
 * @property-read int|null $as_monday_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Week> $as_saturday
 * @property-read int|null $as_saturday_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Week> $as_sunday
 * @property-read int|null $as_sunday_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Week> $as_thursday
 * @property-read int|null $as_thursday_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Week> $as_tuesday
 * @property-read int|null $as_tuesday_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Week> $as_wednesday
 * @property-read int|null $as_wednesday_count
 * @property-read \App\Models\Time $closing_time
 * @property-read \App\Models\Time $opening_time
 * @method static \Illuminate\Database\Eloquent\Builder|Day newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Day newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Day query()
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereClosedTimeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereOpenTimeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereUpdatedAt($value)
 */
	class Day extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $postcode_id
 * @property int $week_id
 * @property-read \App\Models\Postcode $postcode
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|Location scopeDenormalise()
 * @method static \Illuminate\Database\Eloquent\Builder|Location scopeJoin($table, $first, ?string $operator = null, $second = null, string $type = 'inner', bool $where = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Location scopeNearestToPostcode(string $postcode)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location wherePostcodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereWeekId($value)
 */
	class Location extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $postcode
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Location> $location
 * @property-read int|null $location_count
 * @method static \Illuminate\Database\Eloquent\Builder|Postcode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Postcode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Postcode query()
 * @method static \Illuminate\Database\Eloquent\Builder|Postcode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Postcode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Postcode whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Postcode wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Postcode whereUpdatedAt($value)
 */
	class Postcode extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property int $unit_rate_tier_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cashback> $cashbacks
 * @property-read int|null $cashbacks_count
 * @property-read \App\Models\UnitRateTier $unit_rate_tier
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUnitRateTierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $time
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Day> $as_closing_time
 * @property-read int|null $as_closing_time_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Day> $as_opening_time
 * @property-read int|null $as_opening_time_count
 * @method static \Illuminate\Database\Eloquent\Builder|Time newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Time newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Time query()
 * @method static \Illuminate\Database\Eloquent\Builder|Time whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Time whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Time whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Time whereUpdatedAt($value)
 */
	class Time extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $minimum_amount
 * @property int $rate
 * @property int|null $tier_below_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, UnitRateTier> $as_tier_below
 * @property-read int|null $as_tier_below_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $product
 * @property-read int|null $product_count
 * @property-read UnitRateTier|null $tier_below
 * @method static \Illuminate\Database\Eloquent\Builder|UnitRateTier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitRateTier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitRateTier query()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitRateTier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitRateTier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitRateTier whereMinimumAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitRateTier whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitRateTier whereTierBelowId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitRateTier whereUpdatedAt($value)
 */
	class UnitRateTier extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cashback> $cashback
 * @property-read int|null $cashback_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Client> $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Passport\Token> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $day_0
 * @property int|null $day_1
 * @property int|null $day_2
 * @property int|null $day_3
 * @property int|null $day_4
 * @property int|null $day_5
 * @property int|null $day_6
 * @property-read \App\Models\Day|null $friday
 * @property-read \App\Models\Day|null $monday
 * @property-read \App\Models\Day|null $saturday
 * @property-read \App\Models\Day|null $sunday
 * @property-read \App\Models\Day|null $thursday
 * @property-read \App\Models\Day|null $tuesday
 * @property-read \App\Models\Day|null $wednesday
 * @method static \Illuminate\Database\Eloquent\Builder|Week newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Week newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Week query()
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereDay0($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereDay1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereDay2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereDay3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereDay4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereDay5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereDay6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereUpdatedAt($value)
 */
	class Week extends \Eloquent {}
}

