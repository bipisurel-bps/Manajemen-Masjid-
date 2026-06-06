<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashBook extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'is_active', 'created_by'];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function incomeCategories(): HasMany
    {
        return $this->hasMany(Category::class)->where('type', 'income');
    }

    public function expenseCategories(): HasMany
    {
        return $this->hasMany(Category::class)->where('type', 'expense');
    }

    public function totalIncome(): float
    {
        return $this->transactions()->where('type', 'income')->sum('amount');
    }

    public function totalExpense(): float
    {
        return $this->transactions()->where('type', 'expense')->sum('amount');
    }

    public function balance(): float
    {
        return $this->totalIncome() - $this->totalExpense();
    }
}
