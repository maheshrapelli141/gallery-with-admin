<?php namespace App\Models;

use CodeIgniter\Model;

class Counter extends Model
{
    protected $table = 'counter';
    protected $allowedFields = ['count'];
    
    public function getCount(){
      return $this->find(1);
    }

    public function increaseCount(){
      $data = $this->find(1);
      $this->update(1,['count' => $data['count'] + 1]);
      return $data['count']+1;
    }
}