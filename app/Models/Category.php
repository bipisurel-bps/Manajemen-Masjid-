<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    protected $fillable = ['cash_book_id', 'name', 'type'];

    public function cashBook(): BelongsTo
    {
        return $this->belongsTo(CashBook::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
