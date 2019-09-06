<?php

namespace Anacreation\MultiAuth\Controllers;

use Anacreation\MultiAuth\Middleware\AdminAuthMiddleware;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(AdminAuthMiddleware::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('MultiAuth::admin-home');
    }

    public function getProfile() {

        $admin = request()->user();

        return view("MultiAuth::profile", compact('admin'));
    }

    public function putProfile(Request $request) {

        $user = $request->user();
        $validatedData = $this->validate($request, [
            'name'     => 'required',
            'email'    => 'required|email|unique:administrators,email,' .
                          $user->id,
            'password' => 'sometimes|confirmed'
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        if ($password = $validatedData['password']) {
            $user->password = bcrypt($password);
        }

        $user->save();

        return redirect('/admin')->with('status', 'Profile updated');
    }
}
