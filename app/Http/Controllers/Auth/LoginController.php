<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = 'cliente';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // return view('layouts.admin.login');
        if (env('APP_ADMIN') != true) {
            return view('auth.login');
        } else {
            return view('layouts.admin.login');
        }
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {

        $data['success'] = false;
        $data['user']    = false;
        $data['error']   = __('messages.login.error');

        $username  = $request->username;
        $pass_hash = $request->pass_hash;

        if (Auth::attempt(['username' => $username, 'password' => $pass_hash])) {

            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            // return $this->sendLoginResponse($request);
        } else {
            $user = User::where('username', $username)->where('clave', base64_encode($pass_hash))->first();

            if ($user) {
                if ($user->pass_hash == null) {
                    $user->pass_hash = bcrypt(base64_decode($user->clave));
                    $user->save();
                }

                Auth::attempt(['username' => $username, 'password' => $user->pass_hash]);
            }
        }

        if (Auth::check()) {
            if (Auth::user()->role != 'client') {
                Log::info('Usuario logueado: ' . Auth::user()->username . ' ' . Auth::user()->fullName);
                return redirect()->intended('/admin/dashboard');
            } else {
                // if ($request->root() == 'https://beneficiosvacacionales.mx/') {
                return redirect()->route('inicio');
                // } else {
                //     Auth::logout();
                //     return redirect()->intended('https://beneficiosvacacionales.mx');
                // }
            }
        } else {
            return redirect()->back()->withInput()->with('info', '¡Usuario y/o contraseña incorrectos!');
        }

    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login_customer(Request $request)
    {

        $data['success'] = false;
        $data['user']    = false;
        $data['error']   = __('messages.login.error');

        $username  = $request->username;
        $pass_hash = $request->pass_hash;

        if (Auth::attempt(['username' => $username, 'password' => $pass_hash])) {

            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            // return $this->sendLoginResponse($request);
        } else {
            $user = User::where('username', $username)->where('clave', base64_encode($pass_hash))->first();

            if ($user) {
                if ($user->pass_hash == null) {
                    $user->pass_hash = bcrypt(base64_decode($user->clave));
                    $user->save();
                }
                Auth::attempt(['username' => $username, 'password' => $user->pass_hash]);
            }
        }

        if (Auth::check()) {
            if (Auth::user()->role != 'client') {
                Log::info('Usuario logueado: ' . Auth::user()->username . ' ' . Auth::user()->fullName);
                return redirect()->intended('/admin/dashboard');
            } else {
                Auth::logout();
                return redirect()->intended('https://beneficiosvacacionales.mx');
            }
        } else {
            return redirect()->back()->withInput()->with('info', '¡Usuario y/o contraseña incorrectos!');
        }

    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }
}
