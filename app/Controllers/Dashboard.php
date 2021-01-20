<?php namespace App\Controllers;

class Dashboard extends BaseController
{
	public function index()
	{
		$data = [];

		echo view('admin/templates/admin-header', $data);
		echo view('admin/dashboard');
		echo view('admin/templates/admin-footer');
	}

	//--------------------------------------------------------------------

}