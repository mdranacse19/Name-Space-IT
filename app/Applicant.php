<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Applicant extends Authenticatable
{

    use Notifiable;


    /**
     * @var string
     */
    protected $guard    = 'applicant';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'skill', 'resume', 'image', 'status'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];



    /**
     * The Applicant that belong to the JobPost.
     */
    public function jobPosts()
    {
        return $this->belongsToMany('App\JobPost')->withTimestamps();
    }



}
