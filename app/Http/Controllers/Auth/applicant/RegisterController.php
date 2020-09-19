<?php

namespace App\Http\Controllers\Auth\applicant;

use App\Applicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:company');
        $this->middleware('guest:applicant');
    }


    /**
     * show Applicant register page.
     *
     * @return view
     */
    public function showApplicantRegisterForm()
    {
        //return 'success';
        return view('auth.applicant.register');
    }


    /**
     * for data store
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function createApplicant(Request $request)
    {
        //return $request;

        $request->validate([
            'first_name'=> 'required',
            'last_name' => 'required',
            'email'     => 'required|email|max:255|unique:applicants',
            'password'  => 'required|min:3|confirmed',
        ]);


        $data = [
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'email'         => $request->email,
            'skill'         => $request->skill == null ? '' : $request->skill,
            'resume'        => $request->resume == null ? '' : $request->resume,
            'image'         => $request->image == null ? '' : $request->image,
            'password'      => Hash::make($request->password),
            'status'        => '1',
        ];

        Applicant::create($data);
        //return 'success';

        return redirect()->route('login.applicant.show')->with('message', 'Applicant registration successfully !! Please login!');;

    }

}
