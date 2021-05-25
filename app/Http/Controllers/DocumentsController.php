<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Medicament;
use App\Models\OrDetail;
use App\Models\Ordonnance;
use Illuminate\Support\Facades\Auth;
use App\Models\Entete;
use Exception;
use Picqer;

class DocumentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ordonnance()
    {
        $patient_id = session()->get('pat');
        $patient = Patient::where('id', $patient_id)->first();
        $medicaments = Medicament::all();
        return view('patient.patients_ordonnance', [
            'patient' => $patient,
            'medicaments' => $medicaments
        ]);
    }
    public function storeOrdonnance(Request $request)
    {

        $user_id = Auth::id();
        $patient_id = session()->get('pat');
        $data = [
            'user_id' => $user_id,
            'patient_id' => $patient_id
        ];
        $lastinsert = Ordonnance::create($data);

        if (count($request->medicaments) > 0) {
            foreach ($request->medicaments as $item => $v) {
                //
                $data = [
                    'med_lib'       => $request->medicaments[$item],
                    'dosage'        => $request->dosage[$item],
                    'nbr_p_j'       => $request->nbrpj[$item],
                    'nbr_j'         => $request->nbrj[$item],
                    'ordonnance_id' => $lastinsert->id,
                ];

                OrDetail::insert($data);
            }
        }

        return redirect()->route('doc.patients.showOrdonnance', $lastinsert);
    }
    public function showOrdonnance($id)
    {
       
        $patient_id = session()->get('pat');
        $patient = Patient::where('id', $patient_id)->first();
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($patient_id, $generator::TYPE_CODE_128);
        $entete = Entete::with('getWilaya')->first();
        $ordonnance = Ordonnance::with('orDetail')->with('getUser')->find($id);
        return view('patient.documents.ordonnance', [
            'entete' => $entete,
            'ordonnance'=>$ordonnance,
            'patient' => $patient,
            'barcode' => $barcode
        ]);
   
    }
}
