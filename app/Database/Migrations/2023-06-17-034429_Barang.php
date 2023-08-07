<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;
class Barang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'              =>'INT',
                'constraint'        =>11,
                'unsigned'          =>true,
                'auto_increment'    =>true
            ],
            'kd_barang'=>[
                'type'              =>'varchar',
                'constraint'        =>20,
            ],
            'nm_barang'=>[
                'type'              =>'varchar',
                'constraint'        =>100,
            ],
            'stok'=>[
                'type'              =>'INT',
                'constraint'        =>4 ,
            ],
            'created_at' => [
				'type'           => 'TIMESTAMP',
				'null'       	 => true,
                'default'        =>new RawSql('CURRENT_TIMESTAMP'),
			],
			'updated_at' => [
				'type'           => 'TIMESTAMP',
				'null'       	 => true,
                'default'        =>new RawSql('CURRENT_TIMESTAMP'),
			]
           

            ]);
            $this->forge->addKey('id',true);
            $this->forge->createTable('barang');
    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}
