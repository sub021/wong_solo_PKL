<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Karyawan;
use Faker\Factory as Faker;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        $kar = new Karyawan();
        $faker = Faker::create('id_ID');
        $gender = $faker->randomElement(['Laki-laki', 'Perempuan']);
        for ($i = 1; $i <= 20; $i++) {
            $data = [
                'nm_karyawan' => $faker->name($gender),
                'alamat' => $faker->address(),
                'no_hp' => $faker->phoneNumber(),
                'jenis_kelamin' => $gender
            ];
            $kar->save($data);
        }
    }
}
