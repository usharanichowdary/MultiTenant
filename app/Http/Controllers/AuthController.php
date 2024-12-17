<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function login()
    {
        return view('tenant.auth.login');
    }

    public function loginStore(Request $request)
    {
        $credentails = $request->only('email','password');
        $credentails['tenant_id'] = tenant('id');
        
        if(Auth::attempt($credentails)){
            $request->session()->regenerate();
            return redirect()->route('tenant.dashboard');
            
        }

        return back()->withErrors(['email'=>'The provided credentials do not match']);
    }
    

    public function register()
    {
        return view('tenant.auth.register');
    }

    public function registerStore(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required','string','email','max:255',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('tenant_id', tenant('id'))
                                ->where('email', $request);
                }),
            ],
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('tenant.login')->with('success', 'Registration successful. Please log in.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out.');
    }
}
