<?php

namespace App\Http\Controllers;

use App\Models\Medicament;
use App\Models\Patient;
use App\Models\Rdv;
use App\Models\Wilaya;
use Faker\Core\Barcode;
use Faker\Provider\Barcode as ProviderBarcode;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Picqer;




class PatientsController extends Controller
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
        $patients = Patient::where('is_visible', 1)->with('getWilaya')->get();
        return view('doctor.patients_list', [
            'patient' => $patients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wilaya = Wilaya::all();
        $max_code = Patient::latest()->value('code_archive');
        return view('doctor.patients_add', [
            'wilaya' => $wilaya,
            'max_code' => $max_code
        ]);
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
            'f_name.required'       => 'Veuillez saisir un nom',
            'l_name.required'       => 'Veuillez saisir un prénom',
            'birthday.required'     => 'Veuillez saisir une date de naissance',
            'birthday.date'         => 'Veuillez saisir une date de naissance',
            'birthday.date_format'  => 'Format de date incorrect',
            'group_sang.required'   => 'Veuillez choisir un groupe sanguin',
            'phone.required'        => 'Veuillez saisir un numéro téléphone',
            'phone.numeric'         => 'Le numéro téléphone doit être un nombre',
            'code_archive.required' => 'Veuillez saisir un code archive',
            'code_archive.numeric'  => 'Le code archive doit être un nombre',



        ];
        // Validation 
        $this->validate(
            $request,
            [
                'f_name'        => 'required',
                'l_name'        => 'required',
                'birthday'      => 'required|date_format:d-m-Y',
                'group_sang'    => 'required',
                'phone'         => 'required|numeric',
                'code_archive'  => 'required|numeric|unique:patients',
            ],
            $messages
        );
        // Change date format
        $birthday = Carbon::createFromFormat('d-m-Y', $request->birthday)->toDateString();

        //prepare data
        $data = [
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'birthday' => $birthday,
            'gender' => $request->gender ? $request->gender : 1,
            'phone' => $request->phone,
            'wilaya' => $request->wilaya ? $request->wilaya : 30,
            'adresse' => $request->adresse,
            'group_sang' => $request->group_sang,
            'code_archive' => $request->code_archive,
            'user_id' => auth()->user()->id,
        ];
        if ($data)
            Patient::create($data);
        return back()->with('success', 'Vous avez ajouté un patient avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $today = Carbon::today()->toDateString();

        $patient = Patient::where('id', $id)->with('getWilaya')->first();
        session()->put('pat', $patient->id);
        session()->put('pat_f_name', $patient->f_name);
        session()->put('pat_l_name', $patient->l_name);
        $rdv = Rdv::where('patient_id', $id)->with('getTypeCons')->first();
        return view('patient.patients_show', [
            'patient' => $patient,
            'rdv' => $rdv
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wilaya = Wilaya::all();
        $patient = Patient::where('id', $id)->first();
        $birthday = Carbon::createFromFormat('Y-m-d', $patient->birthday);
        $birthday = date_format($birthday, 'd-m-Y');
        return view(
            'doctor.patients_edit',
            [
                'patient' => $patient,
                'wilaya' => $wilaya,
                'birthday' => $birthday
            ]
        );
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
        // Validation message translate to fransh
        $messages = [
            'f_name.required'       => 'Veuillez saisir un nom',
            'l_name.required'       => 'Veuillez saisir un prénom',
            'birthday.required'     => 'Veuillez saisir une date de naissance',
            'birthday.date'         => 'Veuillez saisir une date de naissance',
            'birthday.date_format'  => 'Format de date incorrect',
            'group_sang.required'   => 'Veuillez choisir un groupe sanguin',
            'phone.required'        => 'Veuillez saisir un numéro téléphone',
            'phone.numeric'         => 'Le numéro téléphone doit être un nombre',
            'code_archive.required' => 'Veuillez saisir un code archive',
            'code_archive.numeric'  => 'Le code archive doit être un nombre',



        ];
        // Validation 
        $this->validate(
            $request,
            [
                'f_name'        => 'required',
                'l_name'        => 'required',
                'birthday'      => 'required|date_format:d-m-Y',
                'group_sang'    => 'required',
                'phone'         => 'required|numeric',
                'code_archive'  => 'required|numeric',
            ],
            $messages
        );
        // Change date format
        $birthday = Carbon::createFromFormat('d-m-Y', $request->birthday)->toDateString();

        //prepare data
        $data = [
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'birthday' => $birthday,
            'gender' => $request->gender ? $request->gender : 1,
            'phone' => $request->phone,
            'wilaya' => $request->wilaya ? $request->wilaya : 30,
            'adresse' => $request->adresse,
            'group_sang' => $request->group_sang,
            'code_archive' => $request->code_archive,
            'user_id' => auth()->user()->id,
        ];
        $update = Patient::where('id', $id);
        $update->update($data);
        return back()->with('success', 'Vous avez modifier les informations du patient avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete patient
        $update = Patient::where('id', $id);
        $data = [
            'is_visible' => 0,
        ];
        $update->update($data);
        return back();
    }

    public function salle()
    {

        $today = Carbon::today()->toDateString();

        $patients = Rdv::with('getPatients')->where('date_rdv', $today)->get();

        return view('doctor.patients_salle', ['patients' => $patients]);
    }

    public function listRdv()
    {
        $patient_id = session()->get('pat');
        $patient = Patient::where('id', $patient_id)->with('getWilaya')->first();

        $rdv = Rdv::with('getPatients')
            ->with('getTypeCons')
            ->where('patient_id', $patient_id)
            ->get();

        return view(
            'patient.patients_list_rdv',
            [
                'rdv' => $rdv,
                'patient' => $patient
            ]
        );
    }
    public function history()
    {
        return view('patient.patients_historique');
    }

    public function barcode()
    {
        if(session()->has('pat')){

       
        $patient_id = session()->get('pat');
        $patient = Patient::where('id', $patient_id)->first();
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($patient_id, $generator::TYPE_CODE_128);
        return view(
            'patient.patients_barcode',
            [
                'patient' => $patient,
                'barcode' =>$barcode,
            ]
        );
    }
    return abort(404);
    }
  
}
