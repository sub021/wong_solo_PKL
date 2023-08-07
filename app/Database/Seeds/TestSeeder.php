<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run()
    {
        $this->call('BarangSeeder');
        $this->call('SuplierSeeder');
        $this->call('KaryawanSeeder');
        // $this->call('AuthSeeder');
    }
}
