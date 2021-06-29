<?php

namespace App\Http\Controllers;

use App\Models\Acces;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AccesController extends Controller
{
    function login(){
        return view('acces.login');
    }

    function register(){

        return view('acces.register');
    }

    public function save(Request $request){
        $request->validate([
            'LASTNAME'=>'required',
            'EMAIL'=>'required|email|unique:acces',
            'PASSWD'=>'required|min:5|max:12'
        ]);

        $acces = new Acces;
        $acces->LASTNAME = $request->LASTNAME;
         $acces->EMAIL = $request->EMAIL;
         $acces->PASSWD = Hash::make($request->PASSWD);
         $save = $acces->save();
         if ($save) {
             return back()->with('success', 'Utilisateur créer');
         }else{
             return back()->with('fail','something gone wrong');
         }
    }

    public function check(Request $request){
        // Vérifie si les input sont bien récuperer
        //return $request->input();

        //Validate requests
        $request->validate([
            'EMAIL'=>'required|email',
            'PASSWD'=>'required|min:5|max:12'
       ]);

       $userInfo = Acces::where('EMAIL','=', $request->EMAIL)->first();

       if(!$userInfo){
           return back()->with('fail','We do not recognize your email address');
       }else{
           //check password
           if(Hash::check($request->PASSWD, $userInfo->PASSWD)){
               $request->session()->put('LoggedUser', $userInfo->id);
               return redirect('acces/dashboard');

           }else{
               return back()->with('fail','Incorrect password');
           }
       }
    }

    function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('/acces/login');
        }
    }

    function dashboard(){
        $data = ['LoggedUserInfo'=>Acces::where('id','=', session('LoggedUser'))->first()];
        return view('acces.dashboard', $data);
    }
}
