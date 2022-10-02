<?php

namespace App\Http\Controllers;

use App\Models\TypeAnalyse;
use Illuminate\Http\Request;

class AnalyseController extends Controller
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
        $analyses = TypeAnalyse::orderBy('id','DESC')->get();
        return view('doctor.patients_analyses', [
            'analyses' => $analyses,
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
            'ana.required'       => 'Le champ ne peut pas être vide',
        ];
        // Validation
        $this->validate(
            $request,
            [
                'ana'        => 'required',

            ],
            $messages
        );


      $data=[
          'lib_ana'=>$request->ana,

      ];
      if($data)
      TypeAnalyse::create($data);
      return back()->with('success',"Vous avez ajouté un type d'analyse avec succès");
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
         //delete medicament
         $medicament = TypeAnalyse::find($id);
         $medicament->delete();

         return back()->with('del',"Vous-avez supprimé un type d'analyse");
    }
}
