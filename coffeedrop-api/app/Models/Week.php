<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Week extends Model {
	use HasFactory;

	public function sunday(): BelongsTo {
		return $this->belongsTo(Day::class, 'day_' . Carbon::SUNDAY);
	}

	public function monday(): BelongsTo {
		return $this->belongsTo(Day::class, 'day_' . Carbon::MONDAY);
	}

	public function tuesday(): BelongsTo {
		return $this->belongsTo(Day::class, 'day_' . Carbon::TUESDAY);
	}

	public function wednesday(): BelongsTo {
		return $this->belongsTo(Day::class, 'day_' . Carbon::WEDNESDAY);
	}

	public function thursday(): BelongsTo {
		return $this->belongsTo(Day::class, 'day_' . Carbon::THURSDAY);
	}

	public function friday(): BelongsTo {
		return $this->belongsTo(Day::class, 'day_' . Carbon::FRIDAY);
	}

	public function saturday(): BelongsTo {
		return $this->belongsTo(Day::class, 'day_' . Carbon::SATURDAY);
	}
}
