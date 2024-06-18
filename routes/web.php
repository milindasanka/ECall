<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\jobController;
use App\Http\Controllers\MeetingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/UserRegister', function () {
    return view('user.UserRegister');
});
Route::post('/adduser',[UserController::class,'adduser']);
Route::get('/', 'UserController@welcome')->name('welcome');
Route::get('/search_list', 'UserController@search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home2', 'HomeController@home2')->name('home2');
Route::get('/userlist', 'HomeController@userlist')->name('userlist');
Route::get('/adminjobslist', 'HomeController@jobslist')->name('adminjobslist');

Route::get('/joblist', 'jobController@joblist')->name('joblist');
Route::get('/jobview/{id}{h}', 'jobController@jobview')->name('jobview');
Route::get('/application', 'jobController@application')->name('application');
Route::get('/requestd', 'jobController@requestd')->name('requestd');
Route::get('jobview/applythisjob/{id}', 'jobController@applythisjob')->name('applythisjob');
Route::get('/application', 'jobController@application')->name('application');
Route::post('/deleteapplication', 'jobController@deleteapplication')->name('application.deleteapplication');
Route::post('/deleteapplicationx', 'jobController@deleteapplicationx')->name('application.deleteapplicationx');
Route::post('/acceptjob', 'jobController@acceptjob')->name('application.acceptjob');
Route::get('/viewappliction', 'jobController@viewappliction')->name('application.viewappliction');
Route::post('/addNewjob', 'jobController@addNewjob')->name('addNewjob');
Route::post('/jobdelu', 'jobController@jobdelu')->name('jobdelu');

Route::post('/createmeeting', 'MeetingController@create')->name('createmeeting');
Route::post('/modulatorjoin', 'MeetingController@Modulatorjoin')->name('modulatorjoin');
Route::post('/atendeejoin', 'MeetingController@Atendeejoin')->name('atendeejoin');

Route::get('/addjobpost', function () {
    return view('user.addjobpost');
});

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/cvprofile', 'ProfileController@cvprofile')->name('cvprofile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');
Route::post('/cvprofile', 'ProfileController@updatecv')->name('profile.cvprofile');

Route::get('/about', function () {
    return view('about');
})->name('about');
