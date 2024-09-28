<?php

namespace App\Models;

use Carbon\Carbon;
use Clickbar\Magellan\Database\PostgisFunctions\ST;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Query\JoinClause;

class Location extends Model {
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'postcode_id',
		'week_id',
	];

	public function postcode(): BelongsTo {
		return $this->belongsTo(Postcode::class);
	}

	public function scopeScope_denormalise(Builder $query): void {
		$query
			->getQuery()
			->addSelect('postcodes.postcode')
			->from('locations');
		$query
			->scope_join(
				'postcodes',
				'locations.postcode_id',
				'=',
				'postcodes.id'
			)
			->scope_join(
				'weeks',
				'locations.week_id',
				'=',
				'weeks.id'
			);
		$now = Carbon::now();
		foreach (
			[
				Carbon::SUNDAY,
				Carbon::MONDAY,
				Carbon::TUESDAY,
				Carbon::WEDNESDAY,
				Carbon::THURSDAY,
				Carbon::FRIDAY,
				Carbon::SATURDAY
			] as $day
		) {
			$day_name = $now
				->next($day)
				->dayName;
			$query
				->getQuery()
				->selectRaw("to_char(opening_time_{$day}.time, 'HH24:MI') as opening_time_{$day_name}")
				->selectRaw("to_char(closing_time_{$day}.time, 'HH24:MI') as closing_time_{$day_name}")
				->leftJoin(
					"days as {$day_name}",
					"weeks.day_{$day}",
					'=',
					"{$day_name}.id"
				)
				->leftJoin(
					"times as opening_time_{$day}",
					"{$day_name}.open_time_id",
					'=',
					"opening_time_{$day}.id"
				)
				->leftJoin(
					"times as closing_time_{$day}",
					"{$day_name}.closed_time_id",
					'=',
					"closing_time_{$day}.id"
				);
		}
	}

	public function scopeScope_join(
		Builder $query,
		$table,
		$first,
		?string $operator = null,
		$second = null,
		string $type = 'inner',
		bool $where = false
	): void {
		$join_equals = fn(JoinClause $join_a, JoinClause $join_b) =>
			$join_a->table === $join_b->table
			&& $join_a->wheres === $join_b->wheres
			&& $join_a->type === $join_b->type
			&& $join_a->bindings === $join_b->bindings;
		$test_builder = new QueryBuilder(
			$query
				->getQuery()
				->connection
		);
		$test_builder->join(
			$table,
			$first,
			$operator,
			$second,
			$type,
			$where
		);
		$test_join = $test_builder->joins[0];
		if (
			!collect(
				$query
					->getQuery()
					->joins
			)->contains(fn($join, $key) => $join_equals($join, $test_join))
		) {
			$query
				->getQuery()
				->join(
					$table,
					$first,
					$operator,
					$second,
					$type,
					$where
				);
		}
	}

	public function scopeScope_nearest_to_postcode(Builder $query, string $postcode): void {
		$query
			->getQuery()
			->stOrderBy(
				ST::distanceSpheroid(
					Postcode::firstOrCreate(['postcode' => preg_replace('/\s+/', '', strtoupper($postcode))])->location,
					'postcodes.location'
				)
			);
		$query->scope_join(
			'postcodes',
			'locations.postcode_id',
			'=',
			'postcodes.id'
		);
	}
}
