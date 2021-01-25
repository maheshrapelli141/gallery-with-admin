<?php namespace App\Controllers;

use App\Models\Topic as TopicModel;
use App\Models\Category as CategoryModel;
use App\Models\TopicCategories as TopicCategoriesModel;

class Topic extends BaseController
{
	public function index()
	{
    $data = [];

    
    if ($this->request->getMethod() == 'post') {
      $rules = [
				'name' => 'required|min_length[2]|max_length[50]',
        'description' => 'required|min_length[2]|max_length[1500]',
        'categories' => 'required',
      ];

      $files = $this->request->getFiles();

      $images = NULL;
      // Count total files
      if(!$this->request->getVar('imageUrls') || empty($files['images']))
        $rules['images'] = 'uploaded[images]|max_size[images,5000]|ext_in[images,jpg,jpeg,png],';
      else $images = $this->request->getVar('imageUrls');

			$errors = [];
      
      if (!$this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
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
          'name' => $this->request->getVar('name'),
          'description' => $this->request->getVar('description'),
          'images' => $images
        ];

        $topic_id = $this->request->getVar('topic_id');

        if($topic_id)
          $model->update($topic_id,$newData);
        else {
          $model->save($newData);
          $result = ($model->getLatestTopic())[0];
          $topic_id = $result['id'];
        }

        $selectedCategories = array_unique($this->request->getVar('categories'));
        
        $topic_categories = [];

        foreach($this->request->getVar('categories') as $categoryId){
          $topicCategoriesModel = new TopicCategoriesModel();
          $isExists = $topicCategoriesModel->checkExist($topic_id,$categoryId);
          if(!$isExists){
            $topicCategoriesModel
              ->builder()
              ->insert([
                'topic_id' => $topic_id,
                'category_id' => $categoryId
              ]);
          }
        }

        

        if ($db->transStatus() === FALSE)
        {
          $db->transRollback();
        }
        else
        {
          $db->transCommit();
          $session = session();
          $session->setFlashdata('success', 'Topic Saved Successfully');
        }
      }
      $data['errors'] = $errors;
    }

    $model = new TopicModel();
    //@TODO fetch topics with categories associated with them
    $data['topics'] = $model->getTopics();
    $categoryModel = new CategoryModel();
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
}