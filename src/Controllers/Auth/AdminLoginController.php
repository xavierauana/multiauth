<?php

namespace Anacreation\MultiAuth\Controllers\Auth;

use Anacreation\MultiAuth\Middleware\IsNotAdminMiddleware;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /**
     * AdminLoginController constructor.
     */
    public function __construct() {
        $this->middleware(IsNotAdminMiddleware::class);
    }

    public function getLogin() {
        return view( 'MultiAuth::auth.admin-login');
    }

    public function postLogin(Request $request) {
        // validate form
        $this->validate($request, [
            'email'    => "required|email",
            'password' => "required|min:6",
        ]);

        // login

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];
        $remember = $request->remember;

        // return admin-home if success
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            return redirect()->intended(route('admin.home'));
        }


        // redirect back with old login
        return redirect()->back()->withInput($request->only('email', 'remember'))
                         ->withErrors($errors = ['email' => trans('auth.failed')]);
    }
}