<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;

class Auth extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }
    public function proses_daftar()
    {

        $users= new Users();
        if($this->validate($users->getValidationRules(),
        $users->getValidationMessages())){

       
        $data =[
            'name'=> $this->request->getVar('name'),
            'username'=> $this->request->getVar('username'),
            'password'=> password_hash($this->request->getVar('password'),PASSWORD_BCRYPT),
        ];
 
        // dd($data);
            $users->insert($data);
            return redirect()->to('/login');
        }else{
            $data['Validation']=$this->validator;
            return view ('/register',$data);
        }
    }
    public function login_proses()
    {
        
    }
}
