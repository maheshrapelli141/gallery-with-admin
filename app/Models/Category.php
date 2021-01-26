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
        $categories[$i]['topics'] = count($topics);
      }
      return $categories;
    }
}