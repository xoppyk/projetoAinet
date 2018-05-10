<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'admin', 'blocked', 'phone', 'profile_photo', 'profile_settings','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'password'
    ];

    /**
     * [accounts description]
     * @return [type] [description]
     */
    public function accounts()
    {
        return $this->hasMany('App\Account', 'owner_id');
    }

    public function associates()
    {
        return $this->belongsToMany('App\User', 'associate_members', 'main_user_id', 'associated_user_id')
            ->withPivot('created_at');
    }

    public function associatesOf()
    {
        return $this->belongsToMany('App\User', 'associate_members', 'associated_user_id', 'main_user_id')
            ->withPivot('created_at');
    }

    public function getIsAdminAttribute()
    {
        return $this->admin ? 'Admin' : '';
    }

    public function getIsBlockedAttribute()
    {
        return $this->blocked ? 'Blocked' : '';
    }

}
