<?php
function userIP() {
	  if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	      $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_X_REAL_IP'])) {
	      $user_ip = $_SERVER['HTTP_X_REAL_IP'];
	  } elseif ($_SERVER['REMOTE_ADDR']) {
	      $user_ip = $_SERVER['REMOTE_ADDR'];
	  } else {
	      $user_ip = 'Undefined';
	  }
	  return $user_ip;
}

function userAgent() {
    return $_SERVER['HTTP_USER_AGENT'];
}
function userLocation($user_ip) {
    $url = 'http://ipinfo.io/'.$user_ip;

	  $ch = curl_init($url);

	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

	  $data = curl_exec($ch);

	  curl_close($ch);

    return json_decode($data,true);
}
function currentUrl()
{
	return $_SERVER['SCRIPT_URI'];
}
function visitorToken()
{
		$user_id = rand(100000,999999);

		$chars = str_split("abcdefghijklmnopqrstuvwxyz0123456789");

		$user_token = '';

		// Generate user_token

		for($i = 1; $i <= 10; $i++) {

			// Get a random character

			$n = array_rand($chars, 1);

			// Store random char

			$user_token .= $chars[$n];

		}

    //to check if user is your fan... ;)
		if (isset($_COOKIE['visitor_token'])) {
			$user_cookie = explode("-", $_COOKIE['visitor_token']);
			$user_id = $user_cookie['0'];
			$user_token = $user_cookie['1'];
		}

		setcookie('visitor_token', $user_id."-".$user_token, time() + (86400 * 3650), "/"); // 86400 = 1 day
		return $user_id;
}
function visitor(){
  $user_ip = userIP();  
  $user_agent = userAgent();
  $currenturl = currentUrl();
  $user_location = userLocation($user_ip);
  $user = array('user_ip'    => $user_ip,
      'user_agent' => $user_agent,
      'user_id'    => $user_id,
      'user_token' => $user_token,
      'city'       => $user_location['city'],
      'region'     => $user_location['region'],
      'country'    => $user_location['country'],
      'loc'        => $user_location['loc'],
      'isp'		     => $user_location['org'],
      'timezone'   => $user_location['timezone'],
      'url'        => $user_url);

  // save somewhere $user array to track visitor activity

  $host = "localhost";
  $user = "root";
  $pass = "";
  $db   = "users";

  $db = new mysqli($host, $user, $pass, $db);
  
  // Import visitors.sql file

  $sql = "INSERT INTO `visitors`(`user_id`, `user_token`, `user_ip`, `user_agent`,`url` ,`visitor_from`, `city`, `region`, `country`, `loc`, `isp`, `timezone`, `visited_on`, `last_seen`, `added_on`) 
  VALUES 
  ('".$user['user_id']."','".$user['user_token']."','".$user['user_ip']."','".$user['user_agent']."','".$user['url']."','".$redirect."','".$user['city']."','".$user['region']."','".$user['country']."','".$user['loc']."','".$user['isp']."','".$user['timezone']."','".time()."','".time()."','".date('d-m-Y H:i:s')."')";

	$query = $db->query($sql);  // Make your own db connection.
}
visitor(); //import above code in global files and call this function and boom it's working
