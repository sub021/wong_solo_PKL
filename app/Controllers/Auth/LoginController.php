<?php

namespace App\Controllers\Auth;

use CodeIgniter\Shield\Controllers\LoginController as ShieldLogin;

use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\HTTP\RedirectResponse;

class LoginController extends ShieldLogin
{
    public function loginView()
    {
        return view('auth/login');
    }
}
