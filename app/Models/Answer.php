<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Answer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function resultAnswers(): HasMany
    {
        return $this->hasMany(ResultAnswer::class);
    }

    public function getFullBodyAttribute()
    {
        return sprintf("%s <b>(%s)</b>.", $this->body, $this->is_correct ? 'правильно' : 'неправильно');
    }
}
