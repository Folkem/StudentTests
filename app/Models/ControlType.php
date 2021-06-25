<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ControlType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }
}
