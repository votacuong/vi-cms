<?php
function raw_json_encode($input, $flags = 0) {
	$fails = implode('|', array_filter(array(
		'\\\\',
		$flags & JSON_HEX_TAG ? 'u003[CE]' : '',
		$flags & JSON_HEX_AMP ? 'u0026' : '',
		$flags & JSON_HEX_APOS ? 'u0027' : '',
		$flags & JSON_HEX_QUOT ? 'u0022' : '',
	)));
	$pattern = "/\\\\(?:(?:$fails)(*SKIP)(*FAIL)|u([0-9a-fA-F]{4}))/";
	$callback = function ($m) {
		return html_entity_decode("&#x$m[1];", ENT_QUOTES, 'UTF-8');
	};
	return preg_replace_callback($pattern, $callback, json_encode($input, $flags));
}
function encode_string($string, $key = 'adb-techcom-logistic'){
	if (empty($string))return;
	$key    = sha1($key);
	$strLen = strlen($string);
	$keyLen = strlen($key);
	$j = 0;
	$hash = '';
	for ($i = 0; $i < $strLen; $i++){
		$ordStr = ord(substr($string,$i,1));
		if ($j == $keyLen) { $j = 0; }
		$ordKey = ord(substr($key,$j,1));
		$j++;
		$hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
	}
	return $hash;
}
function decode_string($string, $key = 'adb-techcom-logistic'){
	if (empty($string))return;
	$key    = sha1($key);
	$strLen = strlen($string);
	$keyLen = strlen($key);
	$j = 0;
	$hash = '';
	for ($i = 0; $i < $strLen; $i+=2) {
		$ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
		if ($j == $keyLen) { $j = 0; }
		$ordKey = ord(substr($key,$j,1));
		$j++;
		$hash .= chr($ordStr - $ordKey);
	}
	return $hash;
}
function get_your_session_id($ip = false){
	return encode_string(json_encode(__getBrowser()));
}
function __getBrowser(){ 
	$u_agent  = $_SERVER['HTTP_USER_AGENT'];
	$bname    = 'Unknown';
	$platform = 'Unknown';
	$version  = "";
	if (preg_match('/linux/i', $u_agent)){
		$platform = 'linux';
	}if(preg_match('/macintosh|mac os x/i', $u_agent)){
		$platform = 'mac';
	}elseif(preg_match('/windows|win32/i', $u_agent)){
		$platform = 'windows';
	}
	if(preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)){
		$bname = 'Internet Explorer';
		$ub = "MSIE";
	}elseif(preg_match('/Firefox/i', $u_agent)){
		$bname = 'Mozilla Firefox';
		$ub = "Firefox";
	}elseif(preg_match('/OPR/i', $u_agent)){
		$bname = 'Opera';
		$ub = "Opera";
	}elseif(preg_match('/Chrome/i', $u_agent) && !preg_match('/Edge/i', $u_agent)){
		$bname = 'Google Chrome';
		$ub = "Chrome";
	}elseif(preg_match('/Safari/i', $u_agent) && !preg_match('/Edge/i', $u_agent)){
		$bname = 'Apple Safari';
		$ub = "Safari";
	}elseif(preg_match('/Netscape/i', $u_agent)){
		$bname = 'Netscape';
		$ub = "Netscape";
	}elseif(preg_match('/Edge/i', $u_agent)){
		$bname = 'Edge';
		$ub = "Edge";
	}elseif(preg_match('/Trident/i', $u_agent)){
		$bname = 'Internet Explorer';
		$ub = "MSIE";
	}else{
		$bname = 'Apple Safari';
		$ub = "Safari";
	}
	$known = array('Version', $ub, 'other');
	$pattern = '#(?<browser>' . join('|', $known) .
	')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	if (!preg_match_all($pattern, $u_agent, $matches)) {
		// we have no matching number just continue
	}
	$i = count($matches['browser']);
	if ($i != 1) {
		if (strripos($u_agent, "Version") < strripos($u_agent, $ub)){
			$version = $matches['version'][0];
		}else {
			$version = isset($matches['version'][1])?$matches['version'][1]:1;
		}
	}else {
		$version = $matches['version'][0];
	}
	if ($version == null || $version == "") {$version = "?";}
	return 	array(
		'ub'        => $ub,
		'userAgent' => $u_agent,
		'name'      => $bname,
		'version'   => $version,
		'platform'  => $platform,
		'pattern'   => $pattern			
	);
} 
function uploadFile($id, $name, $sub)
{
	$target_dir = dirname(dirname(dirname(__FILE__)))."/public/images/".$sub.'/';
	$target_file = $target_dir . $id.'.png';
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"]) && is_file($_FILES[$name]["tmp_name"]) ) {
	  $check = getimagesize($_FILES[$name]["tmp_name"]);
	  if($check !== false) {
		$uploadOk = 1;
	  } else {
		$uploadOk = 0;
	  }
	}


	// Check file size
	if ($_FILES[$name]["size"] > 500000) {
	  $uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	  $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	// if everything is ok, try to upload file
	} else {
	  if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
	  } else {
	  }
	}
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
}

function v_base_url( $url )
{
	
	$App = new \Config\App();
	
	$base_url = str_replace('/index.php', '/', $App->baseURL);
	
	return $base_url.'/'.$url;
	
}

function is_empty()
{
	$App = new \Config\App();
	
	$c = str_replace(array($App->baseURL, '/'), array('', ''), getUrl());
	
	return $c == '';
}

function v_redirect( $url )
{
	
	header('Location: '.v_base_url( $url ));
	
	exit();
	
}

function getUrl()
{
	
	return (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
}

function urlOrder($field, $orderby)
{
	
	$url = getUrl();
	
	if( strpos($url, '?') !== false){
		
		$ex = explode('?', $url);
		
		$params = explode('&', $ex[1]);
		
		if ( strpos( $ex[1], 'order=' ) !== false )
		{
			foreach( $params as $key => $value )
			{
				if ( strpos( $value, 'order=' ) !== false )
				{
					
					$params[$key] = 'order='.$field;
					
				}
				
				if ( strpos( $value, 'orderby=' ) !== false )
				{
					
					$params[$key] = 'orderby='.$orderby;
					
				}
				
			}
			return $ex[0].'?'.implode('&', $params);
		}
		else
		{
			
			return $ex[0].'?'.implode('&', $params).'&order='.$field.'&orderby='.$orderby;
			
		}
		
	}
	
	return $url.'?order='.$field.'&orderby='.$orderby;
	
}

function isAdmin()
{
	
	return strpos( getUrl(), 'admin' ) !== false ? true: false;
	
}

function orderby($field)
{
	$url = getUrl();
	
	if( strpos($url, '?') !== false){
		
		$params = explode('?', $url);
		
		if ( strpos($params[1], $field) === true)
		{
			
			return true;
			
		}
		
		$params = explode('&', $params[1]);
		
		foreach( $params as $key => $value )
		{
			
			if ( strpos( $value, $field ) !== false )
			{
				
				foreach( $params as $key => $value )
				{
					
					if ( strpos( $value, 'desc' ) !== false )
					{
						
						return false;
						
					}
				
				}
				
			}
			
		}
		
		return true;
		
	}
	
	return false;
}

function addMessage($message, $type = 'success')
{
	
	$messages = session()->get('messages');
	
	if ( $type == 'success' )
	{
		
		$messages[] = '<div class="text-success">'.$message.'</div>';
		
	}
	else
	{
		$messages[] = '<div class="text-danger">'.$message.'</div>';
		
	}
	
	session()->set('messages', $messages);
}

function showMessages()
{
	
	$messages = session()->get('messages');
	
	if ( !is_array($messages) )
	{
		
		$messages = [];
		
	}
	
	session()->set('messages', []);
	
	if ( count($messages) > 0 )
	{
		return '<div class="col-lg-12 grid-margin">
					<div class="card">
					  <div class="card-body">
							'.implode(PHP_EOL, $messages).'
					  </div>
					</div>
				</div>';
	}
	
}
?>