<?php

namespace App\Controllers;

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

    if($this->request->getMethod() == 'post'){
      //Set form validation
      $rules['name'] = 'trim|required|min_length[4]|max_length[16]';
      $rules['email'] = 'trim|required|valid_email|min_length[6]|max_length[60]';
      $rules['message'] = 'trim|required|min_length[12]|max_length[1500]';
      $rules['phone'] = 'trim|required|min_length[10]|max_length[11]';

      //Run form validation
      $errors = [];
        
      if (!$this->validate($rules, $errors)) {
        $data['validation'] = $this->validator;
        // $data['errors'] = $this->validator->listErrors();
      } else {

        //Get the form data
        $name = $this->request->getVar('name');
        $from_email = $this->request->getVar('email');
        $subject = 'Jeet Props Enquiry';
        $message = $this->request->getVar('message');
        $message = $message.' Phone: '.$this->request->getVar('phone');

        //Web master email
        $to_email = 'mrapelli141@gmail.com'; //Webmaster email, who receive mails

        
        $email = \Config\Services::email();

        //Send mail with data
        $email->setFrom($from_email, $name);
        $email->setTo($to_email);
        $email->setSubject($subject);
        $email->setMessage($message);

        $session = session();
        if ($email->send()) {
          $session->setFlashdata('msg', '<li>Mail sent!</li>');

          redirect('contact');
        } else {
          $session->setFlashdata('msg', '<li>Problem in sending</li>');
          $data['errors'] = $email->printDebugger();
          // $this->load->view('contact');
        }
      }
    }

    echo view('header', $data);
    echo view('contact',$data);
    echo view('footer');
  }

  //--------------------------------------------------------------------

}
