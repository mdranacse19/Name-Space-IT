<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
{
    use Notifiable;


    /**
     * @var string
     */
     protected $guard    = 'company';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = ['first_name', 'last_name', 'email', 'password', 'business_name', 'status'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];


    /*
     * JobPost belongs to Company
     * */
    public function jobPost()
    {
        return $this->hasOne('App\JobPost');
    }


}
