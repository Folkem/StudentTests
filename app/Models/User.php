<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'password',
        'group_id',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function isStudent(): bool
    {
        return !$this->isAdmin() && !$this->isTeacher();
    }

    public function isAdmin(): bool
    {
        return $this->role->name === 'admin';
    }

    public function isTeacher(): bool
    {
        return $this->role->name === 'teacher';
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }
}
