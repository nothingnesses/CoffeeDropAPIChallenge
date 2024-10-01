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
 * @property int $opening_time_id
 * @property int $closing_time_id
 * @method static \Illuminate\Database\Eloquent\Builder|Day newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Day newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Day query()
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereClosingTimeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Day whereOpeningTimeId($value)
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
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
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
 * @property string $location
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
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
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
 * @method static \Illuminate\Database\Eloquent\Builder|UnitRateTier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitRateTier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitRateTier query()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitRateTier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitRateTier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitRateTier whereMinimumAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitRateTier whereRate($value)
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
 * @property int|null $day_0_id
 * @property int|null $day_1_id
 * @property int|null $day_2_id
 * @property int|null $day_3_id
 * @property int|null $day_4_id
 * @property int|null $day_5_id
 * @property int|null $day_6_id
 * @method static \Illuminate\Database\Eloquent\Builder|Week newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Week newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Week query()
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereDay0Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereDay1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereDay2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereDay3Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereDay4Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereDay5Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereDay6Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Week whereUpdatedAt($value)
 */
	class Week extends \Eloquent {}
}

