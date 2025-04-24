<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
		$data = [];
		
		$data = [
		    'subview'=>'home/home.php',
			'title'=>'Home'
		];
		
        return view('front-end/main', $data);
    }
	public function about()
	{
		$data = [];
		if ( $this->request->getVar('submit') )
		{
			$AppConfig = new \Config\AppConfig();
			
			$Mailer = new \App\Libraries\Mailer();
			
			$data = [];
			
			$data['username'] = $this->request->getVar('email');
			
			$data['content'] = $this->request->getVar('name').':'.$this->request->getVar('mail').':'.$this->request->getVar('subject').':'.$this->request->getVar('message');
			
			ob_start();
			
			include(FCPATH . '../app/Views/front-end/login/email.php');
			
			$message = ob_get_clean();
			
			$Mailer->sendMail($AppConfig->mailfrom, 'Customer request', $message );
		
		}
		
		$data = [
		    'subview'=>'about/index.php',
			'title'=>'About'
		];
		
        return view('front-end/main', $data);
	}
}
