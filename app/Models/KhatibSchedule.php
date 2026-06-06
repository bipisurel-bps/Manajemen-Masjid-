<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhatibSchedule extends Model
{
    protected $fillable = ['date', 'khatib_name', 'theme', 'notes'];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }
}
