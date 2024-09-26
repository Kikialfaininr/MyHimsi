<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek kredensial dan lakukan login
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            // Jika autentikasi berhasil
            $user = Auth::user();

            // Logika if-else berdasarkan role user
            if ($user->role == 'Admin') {
                return redirect('/home');
            } elseif ($user->role == 'Pengurus') {
                return redirect('/home');
            } elseif ($user->role == 'Anggota') {
                return redirect('/');
            }
        } else {
            // Jika login gagal, kembalikan ke halaman login dengan pesan error
            return redirect()->back()->withErrors([
                'name' => 'Username atau password salah. Coba lagi!',
            ]);
        }
    }

    /**
     * Logout the user from the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout(); 

        // Optionally invalidate the session and regenerate the token for security
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect the user after logout
        return redirect('/');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */ 
    public function username()
    {
        return 'name';
    }
}

