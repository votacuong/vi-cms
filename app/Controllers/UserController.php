<?php 
namespace App\Controllers;  


use App\Models\UserModel;
use App\Models\AdminUserModel;
use App\Models\CartModel;
use App\Models\AdminOrderModel;
use App\Models\AdminItemModel;
use App\Models\AdminPaymentModel;
use App\Models\AdminProductModel;
use App\Libraries\VLang;
  
class UserController extends BaseController
{
	
	public function lostpassword()
    {
		helper(['Common']);
		
		$UserModel = new UserModel(); 
		
		if ( $UserModel->isLogin( ) )
		{
			v_redirect('');
		}
		
		if ( $this->request->getVar('submit') )
		{
			
			$new_password = generateRandomString();
			
			$UserModel->lostpassword($this->request->getVar('email'), $new_password);
			
			$data = [];
			
			$data['username'] = $this->request->getVar('email');
			
			$data['content'] = 'New password: '.$new_password;
			
			ob_start();
			
			include(FCPATH . '../app/Views/front-end/login/email.php');
			
			$message = ob_get_clean();
			
			$Mailer = new \App\Libraries\Mailer();
			
			$Mailer->sendMail($this->request->getVar('email'), 'lost password', $message );
		
		}
		
        helper(['form', 'Common']);
		
        $data = ['title'=>'Lost password'];
		
        echo view('front-end/login/lostpassword', $data);
    }
		
    public function login()
    {
		$UserModel = new UserModel(); 
		
		if ( $UserModel->isLogin( ) )
		{
			v_redirect('');
		}
		
        helper(['form', 'Common']);
		
        $data = ['system_title'=>'Login'];
		
        echo view('front-end/login/login', $data);
    }
	
	public function signup()
    {
		$UserModel = new UserModel(); 
		
		if ( $UserModel->isLogin( ) )
		{
			v_redirect('');
		}
		
        helper(['form', 'Common']);
		
        $data = [
			'details' => $UserModel->getObject(),
			'system_title'=>'Signup'
		];
		
        echo view('front-end/login/signup', $data);
    }
	
	
	public function doLogin()
	{
		$UserModel = new UserModel(); 
		
		if ( $UserModel->isLogin( ) )
		{
			v_redirect('');
		}
		
		helper(['Common']);
		
		$username = $this->request->getVar('username');
		
		$password = $this->request->getVar('password');
		
		if ( $username != '' && $password != '' )
		{
			
			$UserModel->loginAuth($username, $password);
			
		}
		v_redirect('');
		
	}
  
    public function store($id = 0)
    {
		$UserModel = new UserModel(); 
		
		if ( $UserModel->isLogin( ) )
		{
			v_redirect('');
		}
		
        helper(['form', 'Common']);
		
		if ( $this->request->getVar('submit') )
		{
			$data = [
				
				'id'       => $this->request->getVar('id'),
			
				'user_type'=> $this->request->getVar('user_type'),
				
				'firstname'=> $this->request->getVar('firstname'),
				
				'lastname' => $this->request->getVar('lastname'),
				
				'phone'    => $this->request->getVar('phone'),
				
				'username' => $this->request->getVar('username'),
				
				'email'    => $this->request->getVar('email'),
				
				'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
				
				'state'=> 1
				
			];
			
			if($this->validate($UserModel->validationRules))
			{				
				$insertID = $UserModel->store($data);
				
				$Mailer = new \App\Libraries\Mailer();
				
				$data = [];
			
				$data['username'] = $this->request->getVar('email');
				
				$data['content'] = 'Username:'.$this->request->getVar('email').' and password: '.$this->request->getVar('password');
				
				ob_start();
				
				include(FCPATH . '../app/Views/front-end/login/email.php');
				
				$message = ob_get_clean();
			
				$Mailer->sendMail($this->request->getVar('email'), 'Signup information', $message );
				
				v_redirect('');
				
			}else{
				
				$ndata = [
					
					'details' => $data,
					'title'=>'Edit setting'
				
				];
				
				echo view('front-end/login/signup', $ndata);
			}
		}
		else
		{
			
			$this->signup();
			
		}
    }
	
	public function edit()
    {
        helper(['form', 'Common']);
		
		$UserModel = new UserModel(); 
		
		if ( !$UserModel->isLogin( ) )
		{
			v_redirect('');
		}
		
		$AdminUserModel = new AdminUserModel();
		
		if ( $this->request->getVar('submit') )
		{
			$data = [
				
				'id'       => session()->get('id'),
			
				'user_type'=> $this->request->getVar('user_type'),
				
				'firstname'=> $this->request->getVar('firstname'),
				
				'lastname' => $this->request->getVar('lastname'),
				
				'phone'    => $this->request->getVar('phone'),
				
				'username' => $this->request->getVar('username'),
				
				'email'    => $this->request->getVar('email'),
				
				'language'    => $this->request->getVar('language'),	
				
				'state'    => $this->request->getVar('state'),
				
				'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
				
			];
			
			if($this->validate($AdminUserModel->validationRulesUpdate))
			{
				
				addMessage( VLang::__('MESSAGES_UPDATE_SUCCESSFULY') );
				
				$object = $AdminUserModel->get( session()->get('id') );
				
				$data['email'] = $object['email'];
				
				$data['username'] = $object['username'];
				
				$data['id'] = $object['id'];
				
				uploadFile(session()->get('id'), 'photo', 'users');
				
				$AdminUserModel->store($data);
				
				$ndata = [
		
					'subview' => 'user/edit.php',
					
					'details' => $AdminUserModel->get( session()->get('id') ),
					
					'title'=>'Edit user'
				
				];
				
				$ndata['details'] = array_merge($ndata['details'], $data);
				
				echo view('front-end/main', $ndata);
				
			}else{
				
				$object = $AdminUserModel->get( session()->get('id') );
				
				$ndata = [
		
					'subview' => 'user/edit.php',
					
					'details' => $object,
					
					'title'=>'Edit user'
				
				];
				
				$ndata['details'] = array_merge($ndata['details'], $data);
				
				$ndata['details']['email'] = $object['email'];
				
				$ndata['details']['username'] = $object['username'];
				
				$ndata['details']['id'] = $object['id'];
				
				echo view('front-end/main', $ndata);
			}
		}
		else
		{
			
			$data = [
		
				'subview' => 'user/edit.php',
				
				'details' => $AdminUserModel->get( session()->get('id') ),
				
				'title'=>'Edit user'
			
			];
			
			echo view('front-end/main', $data);
			
		}
    }
	
	public function logout()
	{
		session()->destroy();
		
		v_redirect('');
	}
	
}