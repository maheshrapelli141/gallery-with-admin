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
        'images' => 'uploaded[images]|max_size[images,5000]|ext_in[images,jpg,jpeg,png],'
      ];
      

			$errors = [];
      
      if (! $this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			}else{
        $fileUploads = array();

        // Count total files
        $files = $this->request->getFiles();
        
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
                  throw new RuntimeException($file->getErrorString().'('.$file->getError().')');
              }
          }
        }

        $db = db_connect();

        $db->transBegin();

        $model = new TopicModel();
        $newData = [
          'name' => $this->request->getVar('name'),
          'description' => $this->request->getVar('description'),
          'images' => implode(',',$fileUploads)
        ];

        $topic_id = $this->request->getVar('topic_id');

        if($topic_id)
          $model->update($topic_id,$newData);
        else {
          $model->save($newData);
          $result = ($model->getLatestTopic())[0];
          $topic_id = $result['id'];
        }

        $topic_categories = [];
        foreach($this->request->getVar('categories') as $categoryId){
          array_push($topic_categories, [
            'topic_id' => $topic_id,
            'category_id' => $categoryId
          ]);
        }

        $topicCategoriesModel = new TopicCategoriesModel();
        $topicCategoriesModel
          ->builder()
          ->insertBatch($topic_categories);

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
    }

    $model = new TopicModel();
    $data['topics'] = $model->getTopics();
    $categoryModel = new CategoryModel();
    $data['categories'] = $categoryModel->getCategories();

    /**
     * @TODO fetch topics with categories list to be added
     */
    $topicCategoriesModel = new TopicCategoriesModel();
    $topicCategories = $topicCategoriesModel->getTopicsWithCategories();
    // die(json_encode($topicCategories));
    
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