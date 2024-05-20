<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
  public function landing(){
    return view('sigin.logins');
  }
    public function halamanlogin(){
        return view('sigin.logins');
    }

    public function postlogin(Request $request){
        Session::flash('email',$request->email);
      $request->validate([
        'email'=> 'required',
        'password'=> 'required'
      ],[
        'email.required'=> 'Email wajib di isi',
        
        'password.required'=> 'Password wajib di isi',
      ]);

      $infologin = [
        'email'=> $request->email,
        'password'=> $request->password,
      ];

      if(Auth::attempt($infologin)) {
        return redirect('home');
      }else{
        return redirect('/login')->withErrors('Username dan Password yang dimasukkan tidak valid');
      }
    }
     
    function logout()
    {
        Auth::logout();
        return redirect ('/login')->with('Berhasil Logout');
    }

    // public function logout(){
    //     Auth::logout();
    //     return redirect ('/');
    // }
}
