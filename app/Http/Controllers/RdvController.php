<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Rdv;
use App\Models\Type_consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RdvController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cons_type = Type_consultation::all();


       return view('doctor.patients_list_rdv',compact('cons_type'));

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
            'cons_type'         => 'veuillez sélectionner un type de consultation'




        ];
        // Validation
        $this->validate(
            $request,
            [
                'date'      => 'required|date_format:Y-m-d',
                'cons_type' => 'required'
            ],
            $messages
        );

        $date=$request->date;
        $rdv=Rdv::with('getPatients')->with('getDoctor')->with('getTypeCons')
                ->where('date_rdv',$date)
                ->where('type_cons',$request->cons_type)
                ->get();


        return back()->with('success',$rdv,)->withInput();
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

        $update=Rdv::where('id',$id);
        $data=[
            'etat'=>0,
            'made_by'=>auth()->user()->name
        ];
        $update->update($data);

        return back();
    }
}
