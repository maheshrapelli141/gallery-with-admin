<?php namespace App\Models;

use CodeIgniter\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $allowedFields = ['name'];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    
    function getCategories(){
      return $this->findAll();
    }

    function getById($categoryId){
      return $this->find($categoryId);
    }
}