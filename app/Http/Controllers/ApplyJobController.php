<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplyJobController extends Controller
{
    /*
     * for apply job
     * @param $id
     * */
    public function applyJob($jobId)
    {
        //return $jobId;

        if (!Auth::check()){

            return redirect()->route('login.applicant.show')->with('alert', 'Please Login First !!');
        }else{

            //return redirect()->back()->with('message', 'Apply successfully !!');
            return 'success';
        }


    }



}
