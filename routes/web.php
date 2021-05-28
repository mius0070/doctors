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
Auth::routes(['register' => false,'reset' => false]);

Route::get('/',function(){
    return redirect()->route('login');
});

Route::namespace('App\Http\Controllers')->prefix('doc')->name('doc.')->middleware('doctor')->group(function(){
    Route::resource('/','HomeController');
    Route::get('/print','HomeController@print')->name('print');
    Route::resource('/patients','PatientsController');
    Route::get('/patients/{patient}/del','PatientsController@destroy')->name('patients.del');
    Route::get('/patient/salle','PatientsController@salle')->name('patients.salle');
    Route::get('/patient/gs_rdvs','PatientsController@listRdv')->name('patients.list_rdv');
    Route::get('/patient/historique','PatientsController@history')->name('patients.history');
    Route::get('/patient/barcode','PatientsController@barcode')->name('patients.barcode');
    //documents 
        //ordonnance
    Route::get('/patient/documents/ordonnance','DocumentsController@ordonnance')->name('patients.ordonnance');
    Route::post('/patient/documents/ordonnance/store','DocumentsController@storeOrdonnance')->name('patients.storeOrdonnance');
    Route::get('/patient/documents/ordonnance/show/{id}','DocumentsController@showOrdonnance')->name('patients.showOrdonnance');
        //analyse
    Route::get('/patient/documents/analyses','DocumentsController@analyse')->name('patients.analyse');
    Route::post('/patient/documents/analyses/store','DocumentsController@storeAnalyse')->name('patients.storeAnalyse');
    Route::get('/patient/documents/analyses/show/{id}','DocumentsController@showAnalyse')->name('patients.showAnalyse');
        // certificat medical
    Route::get('/patient/documents/certificat_medical','DocumentsController@certificatMedical')->name('patients.certificat_medical');
    Route::post('/patient/documents/certificat_medical/show','DocumentsController@showCertificatMedical')->name('patients.showCertificat_medical');






    Route::resource('/search','SearchController');
    Route::resource('/calendar','CalendarController');
    Route::resource('/rdv','RdvController');
    Route::get('/rdv/{rdv}/cancel','RdvController@destroy')->name('rdv.cancel');
    Route::resource('/profile','ProfileController');
    // Destroy session
    Route::get('/destroy',function(){
        session()->forget('pat');
        return redirect('/');
    })->name('destroy.session');
    

});
Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->middleware('admin')->group(function(){
    Route::resource('/','HomeController');

});

