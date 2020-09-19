<?php

namespace App\Http\Controllers\applicant;

use App\Applicant;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ApplicantController extends Controller
{
    /*
    * Display a listing of the resource.
    * @return \Illuminate\Http\Response
    * */
    public function index()
    {
        $applicant = Applicant::find(Auth::id());

        return view('applicant.home', compact('applicant'));
    }



    /*
    * update applicant profile.
    * @return \Illuminate\Http\Response
    * */
    public function update(Request $request, $id)
    {
        //return $request;

        $request->validate([
            'first_name'=> 'required',
            'last_name' => 'required',
            'email'     => 'required|email',
            'image'     => 'image|mimes:jpg,png,jpeg,gif,svg',
            'resume'     => 'mimes:doc,pdf,docx',

        ]);

        $image  = $request->file('image');
        $resume = $request->file('resume');
        $slug   = Str::slug($request->first_name);

        //get company partner data
        $applicant = Applicant::find($id);

        //for images
        if (isset($image)){

            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //check folder
            $destinationPath = public_path(). '/assets/images';
            if (is_file($destinationPath.'/'.$applicant->image))
            {
                unlink($destinationPath.'/'.$applicant->image);
            }
            //resize image and save folder
            Image::make($image)->resize(500, 500)->save($destinationPath.'/'.$imageName);
            //return  $imageName;
        }else
        {
            $imageName = $applicant->image;
        }

        //for resume
        if (isset($resume)){

            $currentDate = Carbon::now()->toDateString();
            $resumeName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$resume->getClientOriginalExtension();

            //check folder
            $destinationPath = public_path(). '/assets/images';
            if (is_file($destinationPath.'/'.$applicant->resume))
            {
                unlink($destinationPath.'/'.$applicant->resume);
            }
            //resize image and save folder
            $resume->move($destinationPath, $resumeName);

        }else
        {
            $resumeName = $applicant->resume;
        }


        $data = [
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'skill'         => $request->skill,
            'image'         => $imageName,
            'resume'        => $resumeName,
            'status'        => '1',
        ];

        $save = Applicant::find($id);
        $save->update($data);

        return redirect()->back()->with('message', 'Applicant Profile updated successfully !!')->withInput();

    }


    /*
     * for apply job
     * @param $id
     * */
    public function applyJob($jobId)
    {
        //return $jobId;

        $applicant = Applicant::find(Auth::id());

        //check resume upload or not
        if (empty($applicant->resume)) {

            return redirect()->route('applicant.dashboard')->with('alert', 'Please upload your resume then apply !!');
        } else {

            //if match applicant id and job id then show error message
            $previousInfo = Applicant::join('applicant_job_post as ajp', 'ajp.applicant_id', 'applicants.id')
                ->join('job_posts as post', 'post.id', 'ajp.job_post_id')
                ->where([['applicants.id', Auth::id()], ['post.id', $jobId]])
                ->first();

            if ($previousInfo) {
                return redirect()->back()->with('alert', 'You already applied for this job !!');

            } else {

                $applicant->jobPosts()->attach($jobId);

                return redirect()->back()->with('message', 'Apply successfully !!');
            }
        }


    }




}
