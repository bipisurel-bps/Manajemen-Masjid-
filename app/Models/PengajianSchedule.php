<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajianSchedule extends Model
{
    protected $fillable = [
        'title', 'day_of_week', 'date', 'time',
        'ustadz_name', 'location', 'type', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'time' => 'string',
        ];
    }
}
