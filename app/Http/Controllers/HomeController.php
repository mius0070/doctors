<?php

namespace App\Http\Controllers;

use App\Models\Entete;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('doctor.welcome');
    }
    public function print(){
        
        $entete=Entete::with('getWilaya')->first();
        return view('layouts.print',['entete'=>$entete]);
    }
 
    
}
