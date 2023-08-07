<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Supplier extends Migration
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
            'nm_supplier' => [
                'type'              => 'varchar',
                'constraint'        => 50
            ],
            'kd_supplier' => [
                'type'              => 'varchar',
                'constraint'        => 50
            ],
            'no_hp' => [
                'type'              => 'varchar',
                'constraint'        => 13,
            ],
            'alamat' => [
                'type'              => 'text',
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
        $this->forge->createTable('supplier');
    }

    public function down()
    {
        $this->forge->dropTable('supplier');
    }
}
