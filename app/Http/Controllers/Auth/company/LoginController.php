<?php

namespace App\Http\Controllers\Auth\company;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:company')->except('logout');
        $this->middleware('guest:applicant')->except('logout');

    }


    /**
     * show company login page.
     *
     * @return view
     */
    public function showCompanyLoginForm()
    {
        //return 'success';
        return view('auth.company.login');
    }


    /**
     * login page.
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * redirect auth dashboard
     */
    public function companyLogin(Request $request)
    {
        //return $request;
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:3'
        ]);

        if (Auth::guard('company')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => '1'], $request->get('remember'))) {

            return redirect()->route('company.dashboard');
            //return 'company';

        }

        return back()->withInput($request->only('email', 'remember'));

    }





}
