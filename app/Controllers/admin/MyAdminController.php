<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Config\AuthGroups;

class MyAdminController extends BaseController
{
    public function index()
    {
        $users = auth()->getProvider();
        $data['user'] = $users->withIdentities()->findAll();
        
        return view('admin/admin', $data);
    }

    public function MyRegister()
    {
        $users = auth()->getProvider();
        $user = new User([
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password')
        ]);
        $users->save($user);
        $user = $users->findById($users->getInsertID());
        $users->addToDefaultGroup($user);
        return redirect()->route('user');
    }

    public function MyEdit($id)
    {
        $users = auth()->getProvider();
        $user = $users->findById($id);

        $pass = $this->request->getVar('password');
        if ($pass === null) {
            $user->fill([
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),

            ]);
        } else {
            $user->fill([
                'username' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password')
            ]);
        }
        $users->save($user);
        return redirect()->route('user');
    }

    public function MyDelete($id)
    {
        $users = auth()->getProvider();
        $data = $users->withIdentities()->findById($id);
        $users->delete($data->id, true);
        return redirect()->route('admin');
    }
    public function MyViewRegister()
    {
        return view('admin/MyRegister');
    }

    public function ShowEdit($id)
    {
        $users = auth()->getProvider();
        $data['user'] = $users->withIdentities()->findById($id);
        return view('admin/MyEdit', $data);
    }

    public function MySetting($id)
    {
        $users = auth()->getProvider();
        $data['user'] = $users->withIdentities()->findById($id);
        return view('admin/MyPermission',$data);
    }

    public function MyPermission_pro($id)
    {
        $users = auth()->getProvider();
        $data= $users->withIdentities()->findById($id);
        $group_use =implode( $data->getGroups());
        $group = $this->request->getVar('group');
        $save = $this->request->getVar('save');
        $update = $this->request->getVar('update');
        $delete = $this->request->getVar('delete');


    // dd($group_use);

        $data->removeGroup($group_use);
            $data->addGroup($group);

       
        //hapus group
       
        return redirect()->route('user');
    }
}
