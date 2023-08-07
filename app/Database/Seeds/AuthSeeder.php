<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;

class AuthSeeder extends Seeder
{
    public function run()
    {
        $users = auth()->getProvider();
        $user = new User([
            'username' => 'admin1',
            'email' => 'admin1@admin.com',
            'password' => 'kambing123',
        ]);
        $users->save($user);
        $user = $users->findById($users->getInsertID());
        // $users->addToDefaultGroup($user);
        $user->addGroup('admin');
    }
}
