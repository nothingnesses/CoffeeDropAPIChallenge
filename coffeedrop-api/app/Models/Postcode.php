<?php

namespace App\Models;

use Clickbar\Magellan\Database\Eloquent\HasPostgisColumns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postcode extends Model
{
    use HasFactory;
    use HasPostgisColumns;

    protected array $postgisColumns = [
        'location' => [
            'type' => 'geography',
            'srid' => 4326,
        ],
    ];

}
