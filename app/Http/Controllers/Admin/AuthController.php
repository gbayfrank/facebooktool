<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Admin\AdminController;

class AuthController extends AdminController
{
    public function __construct() {
        $this->pathViewController = "backend.pages.auth.";
        $this->controllerName     = 'auth';
        $this->titlePage          = 'auth';
        parent::__construct();
    }

    public function login() {  
        return view($this->pathViewController . '.login');
    }

    public function logout() {

    }
}