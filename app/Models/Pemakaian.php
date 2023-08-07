<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class Pemakaian extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pemakaian';
    protected $table_barang     = 'barang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['barang_Id', 'stok', 'created_at', 'updated_at'];

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

    public function Simpan_pemakaian_stok($id, $stok)
    {

        // dd($id);

        $this->db->transStart();
        $data_pemakai = array(
            'barang_id' => $id,
            'stok' => $stok
        );
        $this->db->table($this->table)->insert($data_pemakai);
        $data = $this->db->table($this->table_barang)->where('id', $id)
            ->select('stok')
            ->get()
            ->getResult();

        $minStok = (int)$data[0]->stok - (int)$stok;

        $update = $this->db->table($this->table_barang)->set('stok', $minStok);
        $update->where('id', $id)->update();
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
        } else {
            $this->db->transCommit();
        }
    }

    public function ubah_stok_pemakaian($id, $stok, $OldId)
    {
        $this->db->transStart();
        $data_pemakai = array(
            'barang_id ' => $id,
            'stok' => $stok
        );

        $dataOld = $this->db->table($this->table)
            ->where('id', $OldId)
            ->select('stok')
            ->get()
            ->getResult();


        $data = $this->db->table($this->table_barang)->where('id', $id)
            ->select('stok')
            ->get()
            ->getResult();

        $minStok = (int)$data[0]->stok + (int)$dataOld[0]->stok - (int)$stok;
        
        $this->db->table($this->table)
            ->where('id', $OldId)
            ->update($data_pemakai);

        $update = $this->db->table($this->table_barang)
            ->set('stok', $minStok)
            ->where('id', $id)
            ->update();





        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
        } else {
            $this->db->transCommit();
        }
    }
}
