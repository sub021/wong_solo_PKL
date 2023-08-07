<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Barang;
use Faker\Generator as Faker;
// use CodeIgniter\Test\Interfaces\FabricatorModel;


class BarangSeeder extends Seeder
{
    public function run()
    {
        $barangs = new barang();
        $faker = new Faker();
        $faker->addProvider(new \FakerRestaurant\Provider\id_ID\Restaurant($faker));
        for ($i = 1; $i <= 20; $i++) {
            $data = [
                'kd_barang' => 'kb-00' . $i,
                'nm_barang' => $faker->meatName(),
                'stok' => $faker->numberBetween(1, 20),
            ];
            $barangs->save($data);
        }
    }
}
