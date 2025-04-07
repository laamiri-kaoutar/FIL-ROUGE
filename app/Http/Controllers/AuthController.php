<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    
    public function showForgotPasswordForm()
    {
        return view('auth.password-request');
    }

    public function login(LoginRequest  $request)
    {
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role->name === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role->name === 'freelancer') {
                return redirect()->route('freelancer.dashboard');
            } else {
                return redirect()->route('client.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        $roles = Role::whereIn('name', ['client', 'freelancer'])->get(); // hide admin
        return view('auth.register', compact('roles'));
    }

    public function register(RegisterRequest  $request)
    {

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => $request->role_id,
        ]);

        Auth::login($user);

        if ($user->role->name === 'freelancer') {
            return redirect()->route('freelancer.dashboard');
        } else {
            return redirect()->route('client.dashboard');
        }
        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

