<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function correctAnswer()
    {
        return $this->answers()->where('is_correct', true)->first();
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
