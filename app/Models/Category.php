<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\Topic as TopicModel;

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

    function getCategoriesWithTopicsCount(){
      $categories = $this->findAll();
      for($i=0;$i < count($categories);$i++){
        $model = new TopicModel();
        $topics = $model->getByCategoryId($categories[$i]['id']);
        foreach($topics as $topic){
          $images = explode(',',$topic->images);
          if(count($images)){
            $categories[$i]['image'] = $images[0];
            break;
          }
        }
        $categories[$i]['topics'] = count($topics);
      }
      return $categories;
    }

  function findCategories($keywords){
    $builder = $this->builder();
    $builder->orGroupStart();
    foreach ($keywords as $keyword)
    {
        $keyword = trim($keyword);
        $builder->where("`name` LIKE '%$keyword%'");
    }
    $builder->groupEnd();
    $query = $builder->get();
    return $query->getResult();
  }
}