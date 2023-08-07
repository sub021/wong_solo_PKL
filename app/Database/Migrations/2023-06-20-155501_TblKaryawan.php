<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class TblKaryawan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'nm_karyawan' => [
                'type' => 'varchar',
                'constraint' => 50,
            ],
            'alamat' => [
                'type'              => 'text',

            ],
            'no_hp' => [
                'type'              => 'varchar',
                'constraint'        => 13,
            ],
            'jenis_kelamin' => [
                'type'              => 'varchar',
                'constraint'        => 100,
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
        $this->forge->createTable('tbl_karyawan');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_karyawan');
    }
}
