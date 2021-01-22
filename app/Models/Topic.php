<?php namespace App\Models;

use CodeIgniter\Model;

class Topic extends Model
{
    protected $table = 'topics';
    protected $allowedFields = ['name','description','images'];
    protected $useTimestamps = true;
    
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
}