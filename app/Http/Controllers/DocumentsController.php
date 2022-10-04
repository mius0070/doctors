<?php

namespace App\Http\Controllers;

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
            ->where('patient_id', $patient_id)
            ->orderBy('created_at','DESC')
            ->get();

        // Get analyses
        $analyse = Analyse::with('getUser')
            ->where('patient_id', $patient_id)
            ->orderBy('created_at','DESC')
            ->get();
        // Get certificat Medical
        $certificat_medical = CerificatMedical::with('getUser')
            ->where('patient_id', $patient_id)
            ->orderBy('created_at','DESC')
            ->get();
        // Get radio
        $radio = Archive::with(['getUser','getTypeRadio'])
            ->where('patient_id', $patient_id)
            ->orderBy('created_at','DESC')
            ->get();
        //count document
        $doc_count =$certificat_medical->count() + $analyse->count() + $ordonnance->count();
        return view(
            'patient.patients_list_documents',
            [

                'ordonnance' => $ordonnance,
                'analyse' => $analyse,
                'patient' => $patient,
                'certificat_medical' => $certificat_medical,
                'radio' => $radio,
                'doc_count' =>$doc_count
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
                'patient_id' => $patient_id,
                'note' => $request->content,
            ];
            if($data)
            $lastinsert=Ordonnance::create($data);

         return redirect()->route('doc.patients.showOrdonnance', $lastinsert->id);
        }
        return redirect()->route('doc.index');
    }

    public function prepareOrdonnance(Request $request)
    {

        $patient_id = session()->get('pat');
        $patient_id ? null : abort(404);
        $patient = Patient::findOrFail($patient_id);
        $ordonnance =[ $request->all()];

        $barcode = $patient_id;

        $entete = Entete::with('getWilaya')->first();


        return view('patient.documents.prepare_ordonnance', [
            'entete' => $entete,
            'ordonnance' => $ordonnance,
            'patient' =>$patient,
            'barcode' => $barcode
        ]);
    }

    public function showOrdonnance($id)
    {

        $patient_id = session()->get('pat');
        $patient_id ? null : abort(404);
        $ordonnance = Ordonnance::with(['getUser','getPatient'])->findOrFail($id);

        $barcode = $ordonnance->getPatient->id;
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
            return view('patient.patients_analyses', [
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
                'patient_id' => $patient_id,
                'note' => $request->content,
            ];
            if($data)
            $lastinsert=Analyse::create($data);

         return redirect()->route('doc.patients.showAnalyse', $lastinsert->id);
        }
        return redirect()->route('doc.index');
    }
    public function prepareAnalyse(Request $request)
    {

        $patient_id = session()->get('pat');
        $patient_id ? null : abort(404);
        $patient = Patient::findOrFail($patient_id);
        $analyse =[ $request->all()];

        $barcode = $patient_id;

        $entete = Entete::with('getWilaya')->first();


        return view('patient.documents.prepare_analyse', [
            'entete' => $entete,
            'analyse' => $analyse,
            'patient' =>$patient,
            'barcode' => $barcode
        ]);
    }
    public function showAnalyse($id)
    {

        $patient_id = session()->get('pat');
        $patient_id ? null : abort(404);
        $analyse = Analyse::with(['getUser','getPatient'])
            ->findOrFail($id);

        $barcode = $analyse->getPatient->id;
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
            return view('patient.patients_certificat_medical', [
                'patient' => $patient,
            ]);
        }
        return redirect()->route('doc.index');
    }
    public function storeCertificatMedical(Request $request)
    {

        if (session()->has('pat')) {
            $user_id = Auth::id();
            $patient_id = session()->get('pat');
            $data = [
                'nbr_j' => $request->time,
                'date' => $request->date,
                'user_id' => $user_id,
                'patient_id' => $patient_id
            ];

            if ($data) {
                $insert = CerificatMedical::create($data);
            }

            return redirect()->route('doc.patients.showCertificat_medical', $insert);
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

        $barcode = $certificat->getPatient->id;
        $entete = Entete::with('getWilaya')->first();


        return view('patient.documents.certificat_medical', [
            'entete' => $entete,
            'barcode' => $barcode,
            'certificat' => $certificat
        ]);
    }

    // New Radio
    public function radio()
    {
        if (session()->has('pat')) {

            $type_radio = TypeRadio::all();
            return view('patient.patients_new_radio', [
                'type_radio' => $type_radio

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

            if ($request->file('img')) {
                $file_extension = $request->file('img')->getClientOriginalExtension();
                $file_name = time() . "-" . $patient_id . "." . $file_extension;
                $path = 'dist' . '\\' . 'img' . '\\' . 'radio' . '\\';
                $file_path = $request->img->move(public_path($path), $file_name);
            }

            $data = [
                'img_url' => $path . $file_name,
                'note' => $request->note,
                'type_radio_id' => $request->typeradio,
                'user_id' => Auth::user()->id,
                'patient_id' => $patient_id
            ];
            if ($data) {

                Archive::insert($data);
            }
            return redirect()->route('doc.patients.list_doc');
        }
        return redirect()->route('doc.index');
    }
}
