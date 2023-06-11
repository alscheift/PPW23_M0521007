<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // an accessor (it will be called automatically)
    /*public function getUsernameAttribute(string $username): string
    {
        return ucwords($username); // capitalize it
    }*/

    // a mutator (it will be called automatically)
    public function setPasswordAttribute(string $password): void
    {
        // Illuminate\Support\Facades\Hash::check('password', $user->password); to check the password
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getRouteKeyName(): string
    {
        //return parent::getRouteKeyName();
        return 'username';
    }
}
