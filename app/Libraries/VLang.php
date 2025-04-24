<?php
namespace App\Libraries;  

class VLang{
	
	public static $langs = [];
	
	public static function __($code)
	{
		
		if ( count( self::$langs ) == 0 )
		{
			$AppConfig = new \Config\AppConfig();
			
			self::$langs = parse_ini_file( dirname(dirname(__FILE__)). '/Language/countries/'.$AppConfig->system_language.'.ini' );
			
		}
		
		return isset( self::$langs[$code] ) ? self::$langs[$code] : $code;
		
	}
	public static function __e($code)
	{
		
		if ( count( self::$langs ) == 0 )
		{
			$AppConfig = new \Config\AppConfig();
			
			self::$langs = parse_ini_file( dirname(dirname(__FILE__)). '/Language/countries/'.$AppConfig->system_language.'.ini' );
			
		}
		
		echo isset( self::$langs[$code] ) ? self::$langs[$code] : $code;
		
	}
	
}
?>