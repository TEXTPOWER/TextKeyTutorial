<?php
// Include configuration settings
include_once("config.php");

// Add TextKey PHP REST Library
include_once("textkey_rest.php");

// Add TextKey Session Handler
require_once("textkeysite.php");

// Code to handle the login for the specific site
function user_password_login($name, $password) {
	$userid = "";

	//
	// NOTE: This is where you would hook into your own internal authentication handler and return back the user id to 
	// handle assigning a TextKey
	//
	return $name;
}

// Validate the user login and get the TextKey dialog to display in the browser
function login_user() {
	global $textkeysite;

	// Setup
	$error_msg = '';

	// Create the textkey object
	$tk = new textKey(TK_API);
		
	// Get the passed in info.
	$name = isset($_POST["name"]) ? $_POST["name"] : "";
	$password = isset($_POST["password"]) ? $_POST["password"] : "";
	
	// HANDLE THE USER/LOGIN AUTHENTICATION HERE
    // NOTE: The $textkey_userid value should be the user id that was used to register the specific user in the 
    // TextKey Database (i.e. via the TextKey Administration Application or via the  registerTextKeyUser API Call 
	// or registerTextKeyUserCSA API Call).
	$textkey_userid = user_password_login($name, $password);

    // If the username/password combination is validated then continue
	if ($textkey_userid != "") {
	
		// Handle setting the sesssion info.
		$textkeysite->setPassedLoginCheck($name, $textkey_userid);

		// Handle getting a valid TextKey using the user id
		$textkey_result = $tk->perform_IssueTextKeyFromUserId($textkey_userid, TK_ISHASHED);
		if ($textkey_result->errorDescr == "") {
			// No error so setup the return payload
			$reply_msg = '({"error":"", "textkey":' . json_encode($textkey_result->textKey) . ', "textkeyVC":' . json_encode($textkey_result->validationCode) . ', "shortcode":' . json_encode('81888') . '})';
	
			// Handle setting the textkey sesssion info.
			$textkeysite->setTextKeyInfo($textkey_userid, $textkey_result->textKey,  $textkey_result->validationCode, '81888');
	
			// Return the valid info. 
			return $reply_msg;
		}
		else {
			$error_msg = $textkey_result->errorDescr;
		}
	}
	else {
		$error_msg = "The name or password did not match. Please try again...";
	};
	
	// Handle clearing the sesssion info.
	$textkeysite->endSession();

	// Return the error
	$error_msg = '({"error":' . json_encode($error_msg) . '})';
	return $error_msg;
}

// Create the session handling object
$textkeysite = new textkeysite();

// Init the session values
$textkeysite->initSessionInfo();

// Login the user
$login_payload = login_user();

// Return the resulting payload
echo $login_payload;

exit;

?>