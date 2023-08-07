<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class BrMasuk extends Migration
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
            'suplier_id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
            ],
            'created_at' => [
                'type'           => 'TIMESTAMP',
                'null'            => true,
                'default'        => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'           => 'TIMESTAMP',
                'null'            => true,
                'default'        => new RawSql('CURRENT_TIMESTAMP'),
            ]

        ]);
        $this->forge->addKey('id', true);

        $this->forge->addForeignKey('barang_Id', 'barang', 'id', '', '', 'fk_barang_Id');
        $this->forge->addForeignKey('suplier_id', 'supplier', 'id', '', '', 'fk_suplier_id');
        $this->forge->createTable('brmasuk');
    }

    public function down()
    {
        $this->forge->dropForeignKey('brmasuk', 'fk_barang_Id');
        $this->forge->dropForeignKey('brmasuk', 'fk_suplier_id');
        $this->forge->dropTable('brmasuk');
    }
}
