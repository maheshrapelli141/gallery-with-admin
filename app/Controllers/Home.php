<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
    $data  = [];

    echo view('header', $data);
		echo view('welcome_message');
		echo view('footer');
  }
  
  public function photos()
	{
    $data  = [];

    echo view('header', $data);
		echo view('photos');
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
