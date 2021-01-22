<?php namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
  
  protected $table      = 'users';
  protected $primaryKey = 'id';
  protected $useSoftDeletes = true;
  protected $skipValidation     = false;
  protected $useTimestamps = true;
  protected $allowedFields = ['email', 'password', 'updated_at'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];

  function __construct()
  {
        parent::__construct();
  }

  protected function beforeInsert(array $data){
    $data = $this->passwordHash($data);
    $data['data']['created_at'] = date('Y-m-d H:i:s');

    return $data;
  }

  protected function beforeUpdate(array $data){
    $data = $this->passwordHash($data);
    $data['data']['updated_at'] = date('Y-m-d H:i:s');
    return $data;
  }

  protected function passwordHash(array $data){
    if(isset($data['data']['password']))
      $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

    return $data;
  }
}