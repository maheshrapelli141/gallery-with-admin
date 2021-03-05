<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\Category as CategoryModel;

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

    function searchTopics($keywords){
      $topics = $this->builder()
      ->orLike($keywords)
      ->get()
      ->getResultArray();

      // $i=0;
      // foreach($topics as $topic){
      //   $catIds = explode(',',$topic['categories']);
      //   $cats = [];
      //   foreach($catIds as $catId){
      //     $catModel = new Category();
      //     $category = $catModel->getById($catId);
      //     array_push($cats,$category);
      //   }
      //   $topics[$i]['categories'] = $cats;
      //   $i++;
      // }
      return $topics;
    }
}