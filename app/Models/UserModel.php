<?php namespace App\Models;

use CodeIgniter\Model;
use stdClass as stdClass;

class UserModel extends BaseModel
{
	protected $table = 'users';
	
	protected $primaryKey = 'id';
	
	protected $allowedFields = [
	
		'firstname', 
		
		'lastname',
		
		'phone',
		
		'email',
		
		'username',
		
		'password',
		
		'user_type',
		
		'settings', 
		
		'language', 
		
		'state'
		
	];

	protected $useTimestamps = false;

	public $validationRules = [
	
		'user_type' => 'required',
		
		'firstname' => 'required|max_length[100]',
		
		'lastname' => 'required|max_length[100]',
		
		'phone' => 'required|max_length[100]',
		
		'email' => 'required|max_length[100]|valid_email|is_unique[app_users.email,id,{id}]',
		
		'username' => 'required|max_length[100]|is_unique[app_users.username,id,{id}]',
		
		'password' => 'required|min_length[6]|max_length[100]',
		
		'retypePassword' => 'required|min_length[6]|max_length[100]|matches[password]',
		
	];
	
	public $validationRulesUpdate = [
	
		'user_type' => 'required',
		
		'firstname' => 'required|max_length[100]',
		
		'lastname' => 'required|max_length[100]',
		
		'phone' => 'required|max_length[100]',
		
		'password' => 'required|min_length[6]|max_length[100]',
		
		'retypePassword' => 'required|min_length[6]|max_length[100]|matches[password]',
		
	];
	
	protected $validationMessages = [
	
		'user_type' => [
		
		  'required' => 'Usertype field is required'
		  
		],
	
		'firstname' => [
		
		  'required' => 'Firstname field is required',
		  
		  'max_length' => 'Firstname field cannot exceed 100 characters in length',
		  
		],
		
		'lastname' => [
		
		  'required' => 'Lastname field is required',
		  
		  'max_length' => 'Lastname field cannot exceed 100 characters in length',
		  
		],
		
		'phone' => [
		
		  'required' => 'Phone field is required',
		  
		  'max_length' => 'Phone field cannot exceed 100 characters in length',
		  
		],
		
		'email' => [
		
		  'required' => 'Email field is required',
		  
		  'max_length' => 'Email field cannot exceed 100 characters in length',
		  
		  'valid_email' => 'Email field must contain a valid email address',
		  
		  'is_unique' => 'Email field with the same value already exists',
		  
		],
		
		'username' => [
		
		  'required' => 'Username field is required',
		  
		  'max_length' => 'Username field cannot exceed 100 characters in length',
		  
		  'is_unique' => 'Username field with the same value already exists',
		  
		],
		
		'password' => [
		
		  'required' => 'Password field is required',
		  
		  'min_length' => 'Password field must be at least 6 characters in length',
		  
		  'max_length' => 'Password field cannot exceed 100 characters in length',
		  
		],
		
		'retypePassword' => [
		
		  'required' => 'Retype Password field is required',
		  
		  'min_length' => 'Retype Password field must be at least 6 characters in length',
		  
		  'max_length' => 'Retype Password field cannot exceed 100 characters in length',
		  
		  'matches' => 'Retype Password field does not match with Password field',
		  
		]
	];
	
	public function loginAuth($email, $password)
    {

        $data = ( array )$this->builder->where('email', $email)->get()->getFirstRow();
        
        if($data){
			
            $pass = $data['password'];
			
            $authenticatePassword = password_verify($password, $pass);
			
            if($authenticatePassword && $data['state'] == 1){
				
                $ses_data = [
				
                    'id' => $data['id'],
					
                    'name' => $data['firstname']. ' '.$data['lastname'],
					
					'user_type' => $data['user_type'],
					
                    'username' => $data['username'],
					
                    'email' => $data['email'],
					
                    'isLoggedIn' => TRUE,
					
					'area' => 'front-end'
					
                ];
				
                session()->set($ses_data);
				
				return true;
            
            }
        }
		
		return false;
    }
	
	public function lostpassword( $email, $password )
	{
		
		$this->builder->set('password', password_hash($password, PASSWORD_DEFAULT));
		
		$this->builder->where('email', $email);
		
		$this->builder->update();
		
	}
	public function isLogin()
	{
		
		if ( session()->get('area') == 'front-end' || session()->get('area') == 'back-end')
		{
			
			return true;
			
		}
		
		return false;
		
	}
	
	public function getObject()
	{
		
		$user = new stdClass();
		
		$user->id = 0;
		
		$user->user_type = 0;
		
		$user->firstname = '';
		
		$user->lastname = '';
		
		$user->phone = '';
		
		$user->email = '';
		
		$user->username = '';
		
		$user->password = '';
		
		$user->retypePassword = '';
		
		$user->settings = '';
		
		$user->language = '';
		
		$user->state = 0;
		
		$user->clientid = '';
		
		return (array)$user;
	}
}
