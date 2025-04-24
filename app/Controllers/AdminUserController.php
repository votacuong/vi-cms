<?php 
namespace App\Controllers;  


use App\Models\AdminUserModel;
use App\Libraries\VLang;
  
class AdminUserController extends BaseController
{
	
	public function index()
    {
		if ( session()->get('user_type') == 2 )
		{
			addMessage( VLang::__('MESSAGES_DONT_HAVE_PERMISSION'), 'danger' );
			
			v_redirect('admin/dashboard');
		}
        helper(['form', 'Common']);
		
		$AdminUserModel = new AdminUserModel();
		
		if ( $this->request->getVar('query') != '')
		{
			$data = [
				
				'subview' => 'user/index.php',
				
				'query'   => $this->request->getVar('query'),
				
				'list' => $AdminUserModel->selectAll( ['firstname'=>$this->request->getVar('query'), 'lastname'=>$this->request->getVar('query')], $this->request->getVar('order'), $this->request->getVar('orderby') )->paginate(15),
				
				'pager' => $AdminUserModel->pager,
				
				'title'=>'Users'
				
			];
		}
		else
		{
			$data = [
				
				'subview' => 'user/index.php',
				
				'query'   => $this->request->getVar('query'),
				
				'list' => $AdminUserModel->selectAll( [], $this->request->getVar('order'), $this->request->getVar('orderby') )->paginate(15),
				
				'pager' => $AdminUserModel->pager,
				
				'title'=>'Users'
				
			];
		}
		
        echo view('back-end/main', $data);
    }
	
    public function signup()
    {
        helper(['form', 'Common']);
		
        $data = [];
		
        echo view('back-end/login/signup', $data);
    }
	
	public function doLogin()
	{
		
		helper(['Common']);
		
		$AdminUserModel = new AdminUserModel();
		
		$username = $this->request->getVar('username');
		
		$password = $this->request->getVar('password');
		
		if ( $username != '' && $password != '' )
		{
			
			$AdminUserModel->loginAuth($username, $password);
			
		}
		v_redirect('admin/dashboard');
		
	}
  
    public function edit($id = 0)
    {
        helper(['form', 'Common']);
		
		$AdminUserModel = new AdminUserModel();
		
		if ( $id > 0 )
		{
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
					
					'language'    => $this->request->getVar('language'),
					
					'state'    => $this->request->getVar('state'),
					
					'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
					
				];
				
				if($this->validate($AdminUserModel->validationRulesUpdate))
				{
					
					addMessage( VLang::__('MESSAGES_UPDATE_SUCCESSFULY') );
					
					$object = $AdminUserModel->get( $id );
					
					$data['email'] = $object['email'];
					
					$data['username'] = $object['username'];
					
					$data['id'] = $object['id'];
					
					uploadFile($id, 'photo', 'users');
					
					$AdminUserModel->store($data);
					
					$ndata = [
			
						'subview' => 'user/edit.php',
						
						'details' => $AdminUserModel->get( $id ),
			
						'title'=>'Edit user'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					echo view('back-end/main', $ndata);
					
				}else{
					
					$object = $AdminUserModel->get( $id );
					
					$ndata = [
			
						'subview' => 'user/edit.php',
						
						'details' => $object,
			
						'title'=>'Edit user'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					$ndata['details']['email'] = $object['email'];
					
					$ndata['details']['username'] = $object['username'];
					
					$ndata['details']['id'] = $object['id'];
					
					echo view('back-end/main', $ndata);
				}
			}
			else
			{
				
				$data = [
			
					'subview' => 'user/edit.php',
					
					'details' => $AdminUserModel->get( $id ),
			
					'title'=>'Edit user'
				
				];
				
				echo view('back-end/main', $data);
				
			}
		}
        else
		{
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
					
					'language'    => $this->request->getVar('language'),
					
					'state'    => $this->request->getVar('state'),
					
					'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
					
				];
				
				if($this->validate($AdminUserModel->validationRules))
				{
					addMessage( VLang::__('MESSAGES_SAVE_SUCCESSFULY') );
					
					$insertID = $AdminUserModel->store($data);
					
					uploadFile($insertID, 'photo', 'users');
					
					v_redirect('admin/user/edit/'.$insertID);
					
				}else{
					
					$ndata = [
			
						'subview' => 'user/edit.php',
						
						'details' => $AdminUserModel->get( $id ),
			
						'title'=>'Edit user'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					echo view('back-end/main', $ndata);
				}
			}
			else
			{
				
				$data = [
			
					'subview' => 'user/edit.php',
					
					'details' => $AdminUserModel->getObject( ),
			
					'title'=>'Edit user'
				
				];
				
				echo view('back-end/main', $data);
				
			}
			
		}
    }
	
	public function delete($id = 0)
	{
		$AdminUserModel = new AdminUserModel();
		
		if ( $id == 1 )
		{
			addMessage( VLang::__('MESSAGES_DONT_HAVE_PERMISSION'), 'danger' );
		}
		else if( $id > 0 )
		{
			
			$AdminUserModel->deleteItem( $id );
			
			addMessage( VLang::__('MESSAGES_DELETE_SUCCESS') );
			
		}
		
		v_redirect('admin/users');
		
	}
	
	public function state()
	{
		$AdminUserModel = new AdminUserModel();
		
		$AdminUserModel->updateField($this->request->getVar('id'), 'state', $this->request->getVar('state'));
		
		v_redirect('admin/users');
		
	}
	
	public function search()
	{
		header('Content-Type: text/html; charset=utf-8');
		
		$AdminUserModel = new AdminUserModel();
		
		$query = $this->request->getVar('query');
		
		die(json_encode($AdminUserModel->selectAll( $query, 'firstname', 'asc')->paginate(15)));
		
	}
	
	public function logout()
	{
		session()->destroy();
		
		v_redirect('admin/dashboard');
	}
  
}