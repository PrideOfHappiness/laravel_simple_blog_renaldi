<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8|confirmed',
        ]);

        $data = User::where('email', '=', $request->email)->count();
        if($data > 0){
            return back()->withErrors(['email' => 'Invalid email: Email already registered.']);
        }else{
            if($request->password === $request->password_confirmation){
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                Auth::login($user);
    
                return redirect()->route('dashboard');
            }else{
                return back()->withErrors(['password' => 'Invalid password: Password does not match with the Confirm Password.']);
            }
        }
    }
}
