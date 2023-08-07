<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Supplier as suplier;
// use Faker\Generator as Faker;
use Faker\Provider\id_ID\Company as perusa;
use Faker\Provider\id_ID\PhoneNumber as no_hp;
use Faker\Factory as Faker;

class SuplierSeeder extends Seeder
{
    public function run()
    {
        $sup = new suplier();
        $faker = Faker::create();
        $faker->addProvider(new \Faker\Provider\id_ID\Address($faker));
        $faker->addProvider(new perusa($faker));
        $faker->addProvider(new no_hp($faker));
        for ($i = 1; $i <= 20; $i++) {
            $data = [
                'kd_supplier' => 'ks-00' . $i,
                'nm_supplier' => $faker->company(),
                'no_hp' => $faker->phoneNumber(),
                'alamat' => $faker->address()
            ];
            $sup->save($data);
        }
    }
}
