<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Result extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function testing(): BelongsTo
    {
        return $this->belongsTo(Testing::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(ResultAnswer::class);
    }

    public function getGradeAttribute()
    {
        $maxGrade = $this->testing->test->grade;
        $answerCount = $this->testing->test->questions()->count();
        $answerScore = round($maxGrade / $answerCount, 2);
        $accumulatedGrade = 0;
        foreach ($this->answers->map(fn($answer) => $answer->answer) as $answer) {
            if ($answer->is_correct) {
                $accumulatedGrade += $answerScore;
            }
        }

        return "$accumulatedGrade / $maxGrade";
    }
}
