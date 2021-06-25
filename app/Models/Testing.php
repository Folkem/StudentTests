<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Testing extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'started_at' => 'datetime',
    ];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function continues(): bool
    {
        return $this->leftSeconds > 0;
    }

    public function getLeftSecondsAttribute(): int
    {
        return now()->diffInRealSeconds($this->started_at->addMinutes($this->test->time_in_minutes), false);
    }
}
