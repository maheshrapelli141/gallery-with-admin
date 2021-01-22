<?php namespace App\Models;

use CodeIgniter\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $allowedFields = ['name'];

    protected $useTimestamps = true;
    
    function getCategories(){
      return $this->findAll();
    }
}