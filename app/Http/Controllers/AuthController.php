<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

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

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', 'Password reset link sent to your email.')
            : back()->withErrors(['email' => 'We can’t find a user with that email address.']);
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'Password has been reset!')
            : back()->withErrors(['email' => 'Invalid token or email.']);
    }

    public function login(LoginRequest  $request)
    {
        $credentials = $request->only('email', 'password'); 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // $user = Auth::user();
            $user = Auth::user();
            // dd($user);

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
         $user = User::with('role')->find(Auth::id());

         $user = Auth::user();
        //  dd($user);


        if ($user->role->name === 'freelancer') {
            return redirect()->route('freelancer.dashboard');
        } else {
            return redirect()->route('client.dashboard');
        }
        
    }

    public function logout(Request $request)
    {
        // dd($request);
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

