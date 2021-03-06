<?php

namespace Md;

use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Messagable;

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
    protected $fillable = ['verified','hash_id', 'investor_finance', 'investor_amount','first_name', 'last_name', 'email', 'password', 'more_details','userCategory', 'terms', 'moderation_count'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    /**
     * Retrieves the investor details for the user, if he/she is an investor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function investor()
    {
        return $this->hasOne('Md\Investor');
    }

    public function moderator_innovations()
    {
        return $this->hasMany('Md\Innovations', 'moderator_id');
    }

    /**
     * Retrieves the innovator details for the user, if he/she is an innovator.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function innovator()
    {
        return $this->hasOne('Md\Innovator');
    }

    /**
     * Checks if the user is an investor
     *
     * @return bool
     */
    public function isInvestor()
    {
        if($this->userCategory == 2)
            return true;

        return false;
    }

    /**
     * Checks if the user is an innovator.
     *
     * @return bool
     */
    public function isInnovator()
    {
        return !$this->isInvestor() && !$this->isAdmin() && !$this->isMother() && !$this->isModerator();
    }

    public function isAdmin()
    {
        if($this->userCategory == 3)
            return true;

        return false;
    }

    public function isMother()
    {
        if($this->userCategory == 4)
            return true;

        return false;
    }

    public function isModerator()
    {
        if($this->userCategory == 5)
            return true;

        return false;
    }

    /**
     * One to may user innovation relationship
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     */
    public function innovation()
    {
        return $this->hasMany('Md\Innovation');
    }

    public function fund()
    {
        return $this->hasMany('Md\Fund', 'investor_id');
    }

    public function fullName()
    {
        return $this->first_name." ".$this->last_name;
    }

    public function bongo_request()
    {
        return $this->belongsTo('Md\Bongo_request');
    }

    public function investor_request()
    {
        return $this->belongsTo('Md\Investor_request');
    }

    public function prof_pic()
    {
        return $this->hasOne('Md\Profpic');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($user){

            $user->token = str_random(30);

        });
    }

    public function confirmEmail()
    {
        $this->verified = 1;
        $this->token = null;

        $this->save();
    }
}
