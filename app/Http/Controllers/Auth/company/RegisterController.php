<?php

namespace App\Http\Controllers\Auth\company;

use App\Company;
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
     * show company register page.
     *
     * @return view
     */
    public function showCompanyRegisterForm()
    {
        //return 'success';
        return view('auth.company.register');
    }


    /**
     * for data store
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function createCompany(Request $request)
    {
        //return $request;

        $request->validate([
            'first_name'=> 'required',
            'last_name' => 'required',
            'email'     => 'required|email|max:255|unique:companies',
            'password'  => 'required|min:3|confirmed',
        ]);


        $data = [
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'business_name' => $request->business_name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'status'        => '1',
        ];

        Company::create($data);

        return redirect()->route('login.company.show')->with('message', 'Company registration successfully !! Please login!');

    }

}
