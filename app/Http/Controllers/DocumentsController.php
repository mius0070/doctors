<?php

namespace App\Http\Controllers;

use App\Models\AnaDetail;
use App\Models\Analyse;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Medicament;
use App\Models\OrDetail;
use App\Models\Ordonnance;
use Illuminate\Support\Facades\Auth;
use App\Models\Entete;
use App\Models\TypeAnalyse;
use Exception;
use Picqer;

class DocumentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Ordonnace

    public function ordonnance()
    {
        if (session()->has('pat')) {
            $medicaments = Medicament::all();
            return view('patient.patients_ordonnance', [
                'medicaments' => $medicaments
            ]);
        }
        return redirect()->route('doc.index');
    }
    public function storeOrdonnance(Request $request)
    {
        if (session()->has('pat')) {
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
        return redirect()->route('doc.index');
    }
    public function showOrdonnance($id)
    {

        $patient_id = session()->get('pat');
        $patient_id ? null : abort(404);
        $patient = Patient::where('id', $patient_id)->first();
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($patient_id, $generator::TYPE_CODE_128);
        $entete = Entete::with('getWilaya')->first();
        $ordonnance = Ordonnance::with('orDetail')->with('getUser')->find($id);

        return view('patient.documents.ordonnance', [
            'entete' => $entete,
            'ordonnance' => $ordonnance,
            'patient' => $patient,
            'barcode' => $barcode
        ]);
    }

    // analyses

    public function analyse()
    {
        if (session()->has('pat')) {
            $analyse = TypeAnalyse::all();
            return view('patient.patients_analyses',[
                'analyse' => $analyse
            ]);
        }
        return redirect()->route('doc.index');
    }
    public function storeAnalyse(Request $request)
    {
        if (session()->has('pat')) {
            $user_id = Auth::id();
            $patient_id = session()->get('pat');
            $data = [
                'user_id' => $user_id,
                'patient_id' => $patient_id
            ];
            $lastinsert = Analyse::create($data);
                if(count($request->analyse) > 0){
                    foreach($request->analyse as $item => $v ){
                        $data=[
                            'ana_lib' => $request->analyse[$item],
                            'analyse_id'=>$lastinsert->id
                        ];

                        AnaDetail::insert($data);
                    }
                }
           return redirect()->route('doc.patients.showAnalyse', $lastinsert);
        }
        return redirect()->route('doc.index');
    }
    public function showAnalyse($id)
    {

        $patient_id = session()->get('pat');
        $patient_id ? null : abort(404);
        $patient = Patient::where('id', $patient_id)->first();
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($patient_id, $generator::TYPE_CODE_128);
        $entete = Entete::with('getWilaya')->first();
        $analyse = Analyse::with('anaDetail')->with('getUser')->find($id);

        return view('patient.documents.analyse', [
            'entete' => $entete,
            'analyse' => $analyse,
            'patient' => $patient,
            'barcode' => $barcode
        ]);
    }

    // certificat medical


      public function certificatMedical()
      {
          if (session()->has('pat')) {
            $patient_id = session()->get('pat');
            $patient = Patient::where('id', $patient_id)->first();
            return view('patient.patients_certificat_medical',[
                'patient'=>$patient,
            ]);
          }
          return redirect()->route('doc.index');
      }
      public function showCertificatMedical(Request $request)
      {
        $patient_id = session()->get('pat');
        $patient_id ? null : abort(404);
        $patient = Patient::where('id', $patient_id)->first();
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($patient_id, $generator::TYPE_CODE_128);
        $entete = Entete::with('getWilaya')->first();
        $data=[
            'time'=>$request->time,
            'date'=>$request->date,
        ];
        
        return view('patient.documents.certificat_medical',[
            'entete' => $entete,
            'patient' => $patient,
            'barcode' => $barcode,
            'data'    =>$data
        ]);
      }
}
