<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tasks()
    {
        return $this->hasMany(Task::class)->orderBy('date', 'DESC');
    }

    # User has many followers
    # To get all the followers of a user but only IDs
    public function followersID()
    {
        return $this->hasMany(Follow::class, 'following_id');
    }

    # User has many following
    # To get all the users that the user is following but only IDs
    public function followingID()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    # Will return TRUE if the Auth user is following a user.
    public function isFollowed()
    {
        return $this->followersID()->where('follower_id', Auth::user()->id)->exists();
    }
}
