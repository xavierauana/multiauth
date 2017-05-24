<?php

namespace Anacreation\MultiAuth\Controllers;

use Anacreation\MultiAuth\Middleware\AdminAuthMiddleware;
use App\Http\Controllers\Controller;

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
}
