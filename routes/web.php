<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    $post = \App\JobPost::all();
    action('ApplyJobController@index');
    //return view('welcome', compact('post'));
});*/
Route::get('/', 'HomeController@index');

//when applicant are not login then work this route
Route::get('/apply-job/{id}', 'ApplyJobController@applyJob')->name('apply.job');


Auth::routes();


//Route::get('/login', 'HomeController@index')->name('home');


//for company routes
Route::group(['namespace' => 'Auth\company'], function () {

    Route::get('/login/company/show', 'LoginController@showCompanyLoginForm')->name('login.company.show');
    Route::post('/login/company', 'LoginController@companyLogin');
    Route::get('/register/company/show', 'RegisterController@showCompanyRegisterForm');
    Route::post('/register/company/store', 'RegisterController@createCompany');

});
//for applicant routes
Route::group(['namespace' => 'Auth\applicant'], function () {

    Route::get('/login/applicant/show', 'LoginController@showApplicantLoginForm')->name('login.applicant.show');
    Route::post('/login/applicant', 'LoginController@applicantLogin');
    Route::get('/register/applicant/show', 'RegisterController@showApplicantRegisterForm');
    Route::post('/register/applicant/store', 'RegisterController@createApplicant');

});





//for auth company routes
Route::group([ 'prefix' => 'company', 'namespace' => 'company', 'middleware' => 'auth:company' ], function () {

    Route::get('/dashboard', 'CompanyController@index')->name('company.dashboard');


    Route::get('/job-post/create', 'CompanyController@jobPostCreate')->name('company.job-post.create');
    Route::post('/job-post/store', 'CompanyController@jobPostStore')->name('company.job-post.store');

});






//for auth applicant routes
Route::group([ 'prefix' => 'applicant', 'namespace' => 'applicant',  'middleware' => 'auth:applicant' ], function () {

    Route::get('/dashboard', 'ApplicantController@index')->name('applicant.dashboard');

    Route::post('/applicant/update/{id}', 'ApplicantController@update')->name('applicant.update');


    Route::get('/apply-job/{id}', 'ApplicantController@applyJob')->name('apply.job');

});

