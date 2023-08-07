<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    // protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;
    protected $allowedFields    = ['username','password','name','role_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
            'username'     => 'required|alpha_numeric_space|min_length[3]',
            'name'        => 'required|min_length[4]|max_length[100]',
            'password'     => 'required|min_length[8]',
            'password_conf' => 'required_with[password]|matches[password]',
        ];
    protected $validationMessages   = [
            'username'=>[
                'is_unique'=>'maaf, username sudah digunakan',
                'required'=> 'kolom harus diisi',
                'alpha_numeric_space'=>'karakter berupa huruf, angka ',
                'min_length'=>'karakter minimal 3 huruf'
            ],
            'password_conf'=>[
                'matches'=>'konfirmasi password tidak sesuai dengan password',
                'required'=> 'kolom harus diisi'
            ],
            'password'=>[
                'min_length'=>'password kurang dari 8 karakter',
                'required'=> 'kolom harus diisi'
            ],
            'name'=>[
                'required'=> 'kolom harus diisi',
                'min_length'=>'karakter minimal 4 huruf',
                'max_length'=>'karakter maksimal 100 huruf'
            ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = false;

    // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];
}
