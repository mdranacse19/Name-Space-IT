<?php

namespace App\Http\Controllers\company;

use App\Applicant;
use App\Company;
use App\Http\Controllers\Controller;
use App\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /*
    * Display a listing of the resource.
    * @return \Illuminate\Http\Response
    * */
    public function index()
    {
        $applicantList = DB::table('job_posts as jp')
                        ->join('companies as com', 'com.id', 'jp.company_id')
                        ->join('applicant_job_post', 'applicant_job_post.job_post_id', 'jp.id')
                        ->join('applicants as app', 'app.id', 'applicant_job_post.applicant_id')
                        ->select('jp.job_title', 'app.first_name', 'app.last_name', 'app.email'
                            , 'app.skill', 'app.image', 'app.resume')
                        ->where('com.id', Auth::id())
                        ->get();

        /*echo '<pre>';
        print_r($applicantList);
        exit();*/

        return view('company.home', compact('applicantList'));
    }


    /*
     * display job post form
     * return view
     * */
    public function jobPostCreate()
    {
        $company = Company::find(Auth::id());

        return view('company.job-post-create', compact('company'));
    }


    /*
     * display job post form
     * return view
     * */
    public function jobPostStore(Request $request)
    {
        //return $request;

        $request->validate([
            'job_title'         => 'required',
            'salary'            => 'required',
            'country'           => 'required',
            'job_description'   => 'required',
        ]);

        $data = [
            'company_id'      => $request->company_id,
            'job_title'       => $request->job_title,
            'salary'          => $request->salary,
            'location'        => $request->location,
            'country'         => $request->country,
            'job_description' => $request->job_description,
            'status'        => '1',
        ];

        if ($request->rowId == null) {

            JobPost::create($data);

            return redirect()->back()->with('message', 'Job Post Created successfully !!')->withInput();

        }else{
            $save = JobPost::find($request->rowId);
            $save->update($data);

            return redirect()->back()->with('message', 'Job Post Updated successfully !!')->withInput();
        }


    }




}
