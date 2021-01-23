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
}