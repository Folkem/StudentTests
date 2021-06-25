<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Test extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function discipline(): BelongsTo
    {
        return $this->belongsTo(Discipline::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function controlType(): BelongsTo
    {
        return $this->belongsTo(ControlType::class);
    }

    public function testings(): HasMany
    {
        return $this->hasMany(Testing::class);
    }
}
