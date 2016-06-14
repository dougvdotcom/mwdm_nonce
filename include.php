<?php
//the size of our initialization vector is constant, based on cipher
define(MYFORM_IV_SIZE, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

//the encryption key is also constant
//to work with AES / Rijndeal 128, a key string must be 16 basic characters long
//it also needs to be 'packed' into a binary string
define(MYFORM_KEYPHRASE, pack('a*', "WilmaSwimmingNow"));

function my_create_nonce($ttl, $guid) {
	//create IV
	$iv = mcrypt_create_iv(MYFORM_IV_SIZE, MCRYPT_RAND);
	
	//set max length to form submission
	$target = time() + ($ttl * 60);
	
	//add GUID
	$target .= "|$guid";
	
	//encrypt target
	$ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, MYFORM_KEYPHRASE, $target, MCRYPT_MODE_CBC, $iv);
	
	//prepend IV to target so we can decrypt it in a disconnected request
    $ciphertext = $iv . $ciphertext;
	
	//base64 encode that binary so it can be put on a form
    return base64_encode($ciphertext);
}
    
function my_validate_nonce($nonce) {
	//decode nonce text back to binary
	$ciphertext = base64_decode($nonce);
	
	//nonce has to be at least the length of the IV plus 10 characters for a timestamp and 2 characters, at least, for a pipe and a GUID
	if(strlen($ciphertext) < MYFORM_IV_SIZE + 12) { return false; }
	//throw new Exception("The nonce is not of the correct minimal size");
	
	//whack the IV off that binary 
	$iv = substr($ciphertext, 0, MYFORM_IV_SIZE);
	
	//and now get the actual nonce variables
	$ciphertext = substr($ciphertext, MYFORM_IV_SIZE);
	
	//decrypt that nonce back to normal text
	$plaintext = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, MYFORM_KEYPHRASE, $ciphertext, MCRYPT_MODE_CBC, $iv);
	
	//we should be able to explode the result to an array
	//also, the process of decrypting pads our "plaintext" with some hidden garbage that needs to be trimmed
	$vals = explode('|', trim($plaintext));
	
	//if this isn't a pipe-delimited array, it's not our nonce
	if(empty($vals)) { return false; }
	//throw new Exception("Nonce is not in proper format");
	
	//if first argument isn't a timestamp, it's not our nonce
	if(!preg_match('/^\d{10}$/', $vals[0])) { return false; }
	//throw new Exception("Nonce is not properly timestamped");
	
	//if the form hasn't been submitted in the required ttl, it's bad
	if($vals[0] < time()) { return false; }
	//throw new Exception("Nonce was not submitted within the required time");
	
	//all args should match the required values
	if(empty($args) && count($vals) != 2) { return false; }
	//throw new Exception("Nonce contains unexpected variables");

	//nonce passed all checks! return GUID
	return $vals[1];
}

function my_create_guid() {
	//just getting an integer from a text file
	$counter = intval(trim(file_get_contents('guid.txt')));
	$increment = $counter + 1;
	file_put_contents('guid.txt', $increment);
	return $increment;
}

function my_get_guid() {
	//just incrementing the 
	return intval(trim(file_get_contents('guid.txt')));
}
?>
