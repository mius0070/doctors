<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
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
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        //dd($user);
        return view('user.users_profile')->with('user',$user);
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
        //
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
          // Validation message translate to fransh
          $messages = [
            'name.required'       => 'Veuillez saisir un nom',
            'birthday.required'     => 'Veuillez saisir une date de naissance',
            'birthday.date'         => 'Veuillez saisir une date de naissance',
            'birthday.date_format'  => 'Format de date incorrect',
            'email.required'        => 'Veuillez saisir votre email',
            'email.email'        => 'Format de votre email est incorrect',

        ];
        // Validation
        $this->validate(
            $request,
            [
                'name'        => 'required',

                'birthday'      => 'required|date_format:d-m-Y',
                    'email'=>'required|email',

            ],
            $messages
        );
        $birthday = Carbon::createFromFormat('d-m-Y', $request->birthday)->toDateString();

        if($request->has('password')){

            $data = [
                'name'=>$request->name,
                'birthday'=>$birthday,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
              ];
              $update = User::where('id', $id)->update($data);

              return back()->with('success', 'Vous avez modifier les informations de votre profile avec succès');
        }else{
            $data = [
                'name'=>$request->name,
                'birthday'=>$birthday,
                'email'=>$request->email,

              ];
              $update = User::where('id', $id)->update($data);

              return back()->with('success', 'Vous avez modifier les informations de votre profile avec succès');
        }

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
