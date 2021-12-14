<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use Illuminate\Http\Request;

class MedicamentController extends Controller
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
        $medicament = Medicament::all();
        return view('doctor.patients_medicaments', [
            'medicament' => $medicament,
        ]);
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
            'code.required'       => 'Veuillez saisir un code',
            'med.required'       => 'Veuillez saisir un nom',
            'dosage.required'     => 'Veuillez saisir un dosage',
            'prix.required'   => 'Veuillez choisir un prix',




        ];
        // Validation
        $this->validate(
            $request,
            [
                'code'        => 'required',
                'med'        => 'required',
                'dosage'      => 'required',
                'prix'    => 'required',

            ],
            $messages
        );


      $data=[
          'DCI_COD'=>$request->code,
          'DCI_LIB'=>$request->med,
          'DCI_SPEC'=>$request->dosage,
          'DCI_PU'=>$request->prix,

      ];
      if($data)
      Medicament::create($data);
      return back()->with('success', 'Vous avez ajouté un medicament avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function show(Medicament $medicament)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicament $medicament)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicament $medicament)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicament  $medicament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicament $medicament)
    {
        //
    }
}
