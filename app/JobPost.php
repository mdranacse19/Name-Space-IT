<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    protected $fillable = ['company_id', 'job_title', 'salary', 'location', 'country', 'job_description', 'status'];


    /*
     * JobPost belongs to Company
     * */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }


    /**
     * The JobPost that belong to the Applicant.
     */
    public function applicants()
    {
        return $this->belongsToMany('App\Applicant')->withTimestamps();
    }


}
