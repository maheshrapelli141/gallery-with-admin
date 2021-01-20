<?php namespace App\Models;

use CodeIgniter\Model;

class TopicModel extends Model
{
    protected $table = 'topics';

    function getTopicByCategory($categoryId){
      return $this.findAll()
        ->asArray()
        ->where(['categoryId' => $categoryId]);
    }
}