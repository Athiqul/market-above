<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user_access';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = \App\Entities\UserEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['employ_id','name','email','mobile','password','role','status'];

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
}
