<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

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
Auth::routes(['register' => true,'reset' => false]);

Route::get('/',function(){
    return redirect()->route('login');
});

Route::namespace('App\Http\Controllers')->prefix('doc')->name('doc.')->middleware('doctor')->group(function(){
    Route::resource('/','HomeController');
    Route::resource('/patients','PatientsController');
    Route::get('/patients/{patient}/del','PatientsController@destroy')->name('patients.del');
    Route::get('/patient/salle','PatientsController@salle')->name('patients.salle');
    Route::resource('/search','SearchController');
    Route::resource('/calendar','CalendarController');
    Route::resource('/rdv','RdvController');
    // Destroy session
    Route::get('/destroy',function(){
        session()->forget('pat');
        return redirect('/');
    })->name('destroy.session');
   
});
Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->middleware('admin')->group(function(){
    Route::resource('/','HomeController');

});

