<?php

namespace App\Http\Controllers;

use App\Models\AnaDetail;
use App\Models\Analyse;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Medicament;
use App\Models\OrDetail;
use App\Models\Rdv;
use App\Models\Ordonnance;
use Illuminate\Support\Facades\Auth;
use App\Models\Entete;
use App\Models\TypeAnalyse;
use App\Models\CerificatMedical;
use App\Models\TypeRadio;
use App\Models\Archive;
use Illuminate\Support\Carbon;
use Exception;
use Picqer;

class DocumentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //documents
    public function showDocs()
    {
        $patient_id = session()->get('pat');
        $patient = Patient::where('id', $patient_id)->with('getWilaya')->first();


        // Get Ordonannces
        $ordonnance = Ordonnance::with('getUser')
            ->where('patient_id',$patient_id)
            ->get();

        // Get analyses
        $analyse = Analyse::with('getUser')
        ->where('patient_id',$patient_id)
        ->get();
        // Get certificat Medical
        $certificat_medical = CerificatMedical::with('getUser')
        ->where('patient_id',$patient_id)
        ->get();
        // Get radio
        $radio = Archive::with('getUser')
        ->with('getTypeRadio')
        ->where('patient_id',$patient_id)
        ->get();
        return view(
            'patient.patients_list_documents',
            [

                'ordonnance' => $ordonnance,
                'analyse' => $analyse,
                'patient' => $patient,
                'certificat_medical' => $certificat_medical,
                'radio' => $radio
            ]
        );

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
        $ordonnance = Ordonnance::with('orDetail')
        ->with('getUser')
        ->with('getPatient')
        ->findOrFail($id);

        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($ordonnance->getPatient->id, $generator::TYPE_CODE_128);
        $entete = Entete::with('getWilaya')->first();


        return view('patient.documents.ordonnance', [
            'entete' => $entete,
            'ordonnance' => $ordonnance,
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
        $analyse = Analyse::with('anaDetail')
                            ->with('getUser')
                            ->with('getPatient')
                            ->findOrFail($id);

        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($analyse->getPatient->id, $generator::TYPE_CODE_128);
        $entete = Entete::with('getWilaya')->first();


        return view('patient.documents.analyse', [
            'entete' => $entete,
            'analyse' => $analyse,

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
      public function storeCertificatMedical(Request $request){

        if (session()->has('pat')) {
            $user_id = Auth::id();
            $patient_id = session()->get('pat');
            $data = [
                'nbr_j'=>$request->time,
                'date'=>$request->date,
                'user_id' => $user_id,
                'patient_id' => $patient_id
            ];

            if($data){
               $insert= CerificatMedical::create($data);

            }

           return redirect()->route('doc.patients.showCertificat_medical',$insert);
        }
        return redirect()->route('doc.index');
      }
      public function showCertificatMedical($id)
      {
        $patient_id = session()->get('pat');
        $patient_id ? null : abort(404);
        $certificat = CerificatMedical::with('getUser')
                                      ->with('getPatient')
                                      ->findOrFail($id);

        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($certificat->getPatient->id, $generator::TYPE_CODE_128);
        $entete = Entete::with('getWilaya')->first();


        return view('patient.documents.certificat_medical',[
            'entete' => $entete,
            'barcode' => $barcode,
            'certificat' =>$certificat
        ]);
      }

      // New Radio
      public function radio()
      {
          if (session()->has('pat')) {

            $type_radio= TypeRadio::all();
              return view('patient.patients_new_radio', [
                  'type_radio'=>$type_radio

              ]);
          }
          return redirect()->route('doc.index');
      }
      public function storeRadio(Request $request)
      {
          if (session()->has('pat')) {
            $patient_id = session()->get('pat');

             // Validation message translate to fransh
        $messages = [

            'img.required' => 'Veuillez choisir une image.',
            'img.image'    => 'Le ficher doit être une image.',
            'img.mimes'    => 'L\'image doit être un fichier de type : jpeg, png, jpg.',


        ];
        // Validation
        $this->validate(
            $request,
            [
                'typeradio'     => 'required',
                'img'           => 'required|image|mimes:jpeg,png,jpg|max:2048',

            ],
            $messages
        );

        if($request->file('img')){
            $file_extension = $request->file('img')->getClientOriginalExtension();
            $file_name = time()."-".$patient_id.".".$file_extension;
            $path= 'dist'.'\\'.'img'.'\\'.'radio'.'\\';
            $file_path = $request->img->move(public_path($path),$file_name);
        }

        $data = [
            'img_url'=>$path.$file_name,
            'note'=>$request->note,
            'type_radio_id'=>$request->typeradio,
            'user_id' => Auth::user()->id,
            'patient_id' => $patient_id
        ];
        if($data){

            Archive::insert($data);

        }
        return redirect()->route('doc.patients.list_doc');

          }
          return redirect()->route('doc.index');
      }

}
