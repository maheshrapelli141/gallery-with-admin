<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Models\Topic as TopicModel;
use App\Models\Category as CategoryModel;
use App\Models\TopicCategories as TopicCategoriesModel;

class Topic extends BaseController
{
  use ResponseTrait;

  public function saveTopic(){
    $input = service('request')->getPost();
    $data = [
      'csrf' => csrf_hash()
    ];
      $rules = [
				'name' => 'required|min_length[2]|max_length[50]',
        'description' => 'required|min_length[2]|max_length[1500]',
        'categories' => 'required',
      ];

      $files = $this->request->getFiles();
      $images = NULL;
      // Count total files
      if(!$input['imageUrls'] || empty($files['images']))
        $rules['images'] = 'uploaded[images]|max_size[images,10000]|ext_in[images,jpg,jpeg,png],';
      else $images = $input['imageUrls'];

			$errors = [];
      
      if (!$this->validate($rules, $errors)) {
        // $data['validation'] = $this->validator;
        $data['errors'] = $this->validator->listErrors();
        return $this->respond($data, 400);
			}else{
        $fileUploads = array();

        // Looping all files
        if($imagefile = $files){
          foreach($imagefile['images'] as $img)
          {
              if ($img->isValid() && ! $img->hasMoved())
              {
                  $newName = $img->getRandomName();
                  $fileDetails = $img->move('uploads', $newName);
                  $filepath = base_url()."/uploads/".$newName;
                  array_push($fileUploads,$filepath);
              } else {
                  $data['errors'] = $img->getErrorString();
                  // throw new \RuntimeException($img->getErrorString().'('.$img->getError().')');
              }
          }
          if(!$images)
            $images = implode(',',$fileUploads);
          else $images = $images.','.implode(',',$fileUploads);
          $images = trim($images,',');
          $images = trim($images,'');
          
          if(strlen($images) === 0)
            $images = NULL;
        }

        $db = db_connect();
        $db->transBegin();

        $model = new TopicModel();

        $newData = [
          'name' => $input['name'],
          'description' => $input['description'],
          'categories' => implode(',',$input['categories']),
          'images' => $images
        ];
        
        $topic_id = $input['topic_id'];

        if($topic_id)
          $model->update($topic_id,$newData);
        else {
          $model->save($newData);
          $result = ($model->getLatestTopic())[0];
          $topic_id = $result['id'];
        }

        if ($db->transStatus() === FALSE)
        {
          $db->transRollback();
        }
        else
        {
          $db->transCommit();
          // $session = session();
          // $session->setFlashdata('success', 'Topic Saved Successfully');
          $data['message'] = 'Topic Saved Successfully';
          $data['status'] = true;
          return $this->respond($data, 200);
        }
      }  
    $data['errors'] = $errors;
    return $this->respond($data, 422);
  }

	public function index()
	{
    $data = [];

    $model = new TopicModel();
    $data['topics'] = $model->getTopics();

    $categoryModel = new CategoryModel();
    for($i=0;$i< count($data['topics']);$i++){
      $topic = $data['topics'][$i];
      $categoriesList = [];
      $categoryIds = str_getcsv($topic['categories']);
      foreach($categoryIds as $categoryId){
        array_push($categoriesList,$categoryModel->getById($categoryId));
      }
      $data['topics'][$i]['categories'] = $categoriesList;
    }
    
    $data['categories'] = $categoryModel->getCategories();
    
		echo view('admin/templates/admin-header', $data);
		echo view('admin/topic',$data);
		echo view('admin/templates/admin-footer');
	}

	//--------------------------------------------------------------------
  public function delete()
  { 
    $model = new TopicModel();
    $model->delete($this->request->getVar('id'));
    
    return redirect()->to('/admin/topic');
  }

  function getByCategoryId($categoryId){
    $model = new TopicModel();
    $topics = $model->getByCategoryId($categoryId);
    $data = [
      'data' => $topics,
      'message' => 'Success'
    ];
    return $this->respond($data, 200);
    // die($categoryId);
  }
}