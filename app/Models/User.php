<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = strlen($value) === 60 && preg_match('/^\$2y\$/', $value)
            ? $value
            : Hash::make($value);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isReporter()
    {
        return $this->role === 'reporter';
    }
}
