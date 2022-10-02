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
            'med.required'       => 'Veuillez saisir un nom',
            'dosage.required'     => 'Veuillez saisir un dosage',




        ];
        // Validation
        $this->validate(
            $request,
            [
                'med'        => 'required',
                'dosage'      => 'required',

            ],
            $messages
        );


      $data=[
          'DCI_LIB'=>$request->med,
          'DCI_SPEC'=>$request->dosage,

      ];
      if($data)
      Medicament::create($data);
      return back()->with('success', 'Vous avez ajouté un médicament avec succès');
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
    public function destroy($id)
    {
         //delete medicament
         $medicament = Medicament::find($id);
         $medicament->delete();

         return back()->with('del','Vous-avez supprimé un médicament');
    }
}
