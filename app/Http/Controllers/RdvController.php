<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Rdv;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RdvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

       return view('doctor.patients_list_rdv');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation message translate to fransh
        $messages = [
            'date.required'     => 'Veuillez saisir une date ',
            'date.date_format'  => 'Format de date incorrect',
           


            
        ];
        // Validation 
        $this->validate(
            $request,
            [
                'date'      => 'required|date_format:d-m-Y',
            ],
            $messages
        );
        // Change date format
       $date = Carbon::createFromFormat('d-m-Y', $request->date)->toDateString();

        $rdv=Rdv::with('getPatients')->with('getDoctor')
                ->where('date_rdv',$date)
                ->get();
        
        
        return back()->with('success',$rdv);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
