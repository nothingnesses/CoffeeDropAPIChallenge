<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Postcode extends Model
{
    use HasFactory;

    public function business_hours(): HasMany {
        return $this->hasMany(BusinessHours::class);
    }
}
