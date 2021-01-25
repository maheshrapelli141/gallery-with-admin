<?php namespace App\Models;

use CodeIgniter\Model;

class Topic extends Model
{
    protected $table = 'topics';
    protected $allowedFields = ['name','description','images'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    
    function getTopics(){
      return $this->builder()
        ->select('topics.id,topics.name as "topic_name",topics.description,topics.images,c.name as "category"')
        ->where('topics.deleted_at',NULL)
        ->from('topic_categories tc')
        ->join('topics t','t.id = tc.topic_id')
        ->join('categories c','c.id = tc.category_id ')
        ->get()
        ->getResult();
    }

    function getLatestTopic(){
      return $this->builder()
        ->orderBy('created_at','DESC')
        ->limit(1)
        ->get()
        ->getResultArray();
    }

}