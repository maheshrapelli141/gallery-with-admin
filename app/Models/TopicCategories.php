<?php namespace App\Models;

use CodeIgniter\Model;

class TopicCategories extends Model
{
    protected $table = 'topic_categories';
    protected $allowedFields = ['topic_id','category_id'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;

    function getTopicsWithCategories(){
      return $this->findAll();
    }

    function checkExist($topicId,$categoryId){
      $record = $this->builder()
      ->orGroupStart()
        ->where('topic_id', $topicId)
        ->where('category_id', $categoryId)
      ->groupEnd()
      ->get()
      ->getResult();

      if(empty($record)) return false;
      return true;
    }
}