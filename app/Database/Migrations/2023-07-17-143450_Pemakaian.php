<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;
class Pemakaian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true
            ],
            'barang_Id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'          => true,
            ],
            'stok' => [
                'type'              => 'INT',
                'constraint'        => 4,

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
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('barang_Id', 'barang', 'id', '', '', 'barang_Id_fk');
        $this->forge->createTable('pemakaian');
    }

    public function down()
    {
        $this->forge->dropForeignKey('pemakaian', 'barang_Id_fk');
        $this->forge->dropTable('pemakaian');
    }
}
