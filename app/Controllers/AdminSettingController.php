<?php 
namespace App\Controllers;  

use App\Libraries\VLang;

class AdminSettingController extends BaseController
{
	
	public function index()
    {
		if ( session()->get('user_type') != 1 )
		{
			addMessage( VLang::__('MESSAGES_DONT_HAVE_PERMISSION'), 'danger' );
			
			v_redirect('admin/dashboard');
			
		}
		
        helper(['form', 'Common']);
		
		
		$config = new \Config\AppConfig();
		
		if ( $this->request->getVar('submit') )
		{
			$content = '<?php
namespace Config;

class AppConfig{
';

			$fields = [];
			
			foreach($_POST as $key => $value )
			{
				
				if ( $key != 'submit' )
				{
					
					$config->{$key} = $value;
					
					$fields[] = "	public $".$key." = '".$value."';"; 
					
				}
				
			}
			$content .= implode(PHP_EOL, $fields).PHP_EOL.'}';
			
			file_put_contents(dirname(dirname(__FILE__)).'/Config/AppConfig.php', $content);
			
			addMessage( VLang::__('MESSAGES_UPDATE_SUCCESSFULY') );
			
		}
		
        $data = [
		
			'subview'=>'setting/index.php',
			
			'details'=>$config,
			
			'title'=>'Settings'
			
		];
		
        echo view('back-end/main', $data);
    }
}
?>