<?php namespace App\Models;

use CodeIgniter\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $allowedFields = ['name'];

    function getCategories(){
      return $this->findAll();
    }
}