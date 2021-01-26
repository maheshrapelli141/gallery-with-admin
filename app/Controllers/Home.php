<?php namespace App\Controllers;

use App\Models\Topic;

class Home extends BaseController
{
	public function index()
	{
    $data  = [];

    echo view('header', $data);
		echo view('welcome_message');
		echo view('footer');
  }
  
  public function topics($categoryId)
	{
    $topicModel = new Topic();
    $topics = $topicModel->getByCategoryId($categoryId);
    $data  = [
      'categoryId' => $categoryId,
      'topics' => $topics
    ];

    echo view('header', $data);
		echo view('topics', $data);
		echo view('footer');
  }

  public function single($topicId)
	{
    $topicModel = new Topic();
    $topic = $topicModel->find($topicId);
    $data  = [
      'topic' => $topic
    ];

    echo view('header', $data);
		echo view('single', $data);
		echo view('footer');
  }
  
  public function about()
	{
    $data  = [];

    echo view('header', $data);
		echo view('about');
		echo view('footer');
  }
  
  public function contact()
	{
    $data  = [];

    echo view('header', $data);
		echo view('contact');
		echo view('footer');
	}

	//--------------------------------------------------------------------

}
