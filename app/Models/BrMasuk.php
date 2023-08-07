<?php

namespace App\Models;

use CodeIgniter\Model;

class BrMasuk extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'brmasuk';
    protected $table_barang     = 'barang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['barang_Id', 'stok', 'suplier_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function simpan_masuk_stok($id, $stok, $supId)
    {
        $this->db->transStart();
        $data_masuk = [
            'barang_Id' => $id,
            'stok' => $stok,
            'suplier_id' => $supId
        ];
        $this->db->table($this->table)
            ->insert($data_masuk);
        $data = $this->db->table($this->table_barang)
            ->where('id', $id)
            ->select('stok')
            ->get()
            ->getResult();

        $plusStok = (int)$data[0]->stok + (int)$stok;

        $update = $this->db->table($this->table_barang)
            ->set('stok', $plusStok);

        $update->where('id', $id)
            ->update();
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
        } else {
            $this->db->transCommit();
        }
    }

    public function ubah_stok_masuk($id, $stok, $supId, $OldId)
    {
        $this->db->transStart();
        $data_masuk = [
            'barang_Id' => $id,
            'stok' => $stok,
            'suplier_id' => $supId
        ];

        $dataOld = $this->db->table($this->table)
            ->where('id', $OldId)
            ->select('stok')
            ->get()
            ->getResult();

        $data = $this->db->table($this->table_barang)
            ->where('id', $id)
            ->select('stok')
            ->get()
            ->getResult();

        $plusStok = (int)$data[0]->stok + (int)$dataOld[0]->stok - (int)$stok;

        $this->db->table($this->table)
            ->where('id', $OldId)
            ->update($data_masuk);

        $update = $this->db->table($this->table_barang)
            ->set('stok', $plusStok)
            ->where('id', $id)
            ->update();
    }
}
