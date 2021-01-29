<?php namespace App\Models;

use CodeIgniter\Model;

class Topic extends Model
{
    protected $table = 'topics';
    protected $allowedFields = ['name','description','images','categories'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    
    function getTopics(){
      return $this->findAll();
    }

    function getLatestTopic(){
      return $this->builder()
        ->orderBy('created_at','DESC')
        ->limit(1)
        ->get()
        ->getResultArray();
    }

    function getByCategoryId($categoryId){
      return $this->query('SELECT * FROM topics WHERE FIND_IN_SET('.$categoryId.',categories)')->getResult();
    }


    function getTotalCount(){
      return $this->builder()->countAllResults();
    }

}