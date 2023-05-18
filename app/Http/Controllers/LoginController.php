<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        if (!Auth::check()) {
            return view('login.index');
        }
        return redirect('events');
        
    }

    public function auth(Request $request)
    {
        $credential = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        //dd('aqui');
        if (Auth::attempt($credential)) {

            $request->session()->regenerate();
            return redirect()->intended('events'); //retorna para a última view
        } else {
            return redirect()->back()->with('status', 'Email ou Senha errada');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
