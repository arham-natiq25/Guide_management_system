<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    function index() {
        return view('admin.auth.login');
    }
    function register() {
        return view('admin.auth.register');
    }
    function dashboard() {
        return view('admin.index');
    }
    function forget_password()  {
        return view('admin.auth.forget-password');
    }
}
