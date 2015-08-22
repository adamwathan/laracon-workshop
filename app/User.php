<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id');
    }

    public function timeline()
    {
        $following_ids = $this->following()->lists('following_id');
        return Tweet::whereIn('user_id', $following_ids)->latest();
    }

    public function follow($user)
    {
        $this->following()->attach($user);
    }

    public function unfollow($user)
    {
        $this->following()->detach($user);
    }

    public function follows($user)
    {
        return $this->following->contains($user);
    }

    public function notFollowing()
    {
        $following_ids = $this->following()->lists('following_id');
        return User::whereNotIn('id', $following_ids);
    }
}