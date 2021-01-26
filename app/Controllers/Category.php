<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Models\Category as CategoryModel;

class Category extends BaseController
{
  use ResponseTrait;

	public function index()
	{
    $data = [];

    if ($this->request->getMethod() == 'post') {
      $rules = [
				'category' => 'required|min_length[2]|max_length[50]',
			];

			$errors = [];
      
      if (! $this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			}else{
        $model = new CategoryModel();
        $newData = [
          'name' => $this->request->getVar('category')
        ];
        if($this->request->getVar('category_id'))
          $model->update($this->request->getVar('category_id'),$newData);
        else 
          $model->save($newData);
        $session = session();
				$session->setFlashdata('success', 'Category Saved Successfully');
      }
    }

    $model = new CategoryModel();
    $data['categories'] = $model->getCategories();
    // die(json_encode($data['categories']));
		echo view('admin/templates/admin-header', $data);
		echo view('admin/category-list',$data);
		echo view('admin/templates/admin-footer');
	}

	//--------------------------------------------------------------------
  public function delete()
  { 
    $model = new CategoryModel();
    $model->delete($this->request->getVar('id'));
    
    return redirect()->to('/admin/category');
  }

  function getCategories(){
    $model = new CategoryModel();
    $data = $model->getCategoriesWithTopicsCount();
    return $this->respond([
      'message' => 'Categories fetched successfully',
      'status' => true,
      'data' => $data
    ], 200);
  }
}