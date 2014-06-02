<?php
// Include configuration settings
include_once("config.php");

// Add TextKey PHP REST Library
include_once("textkey_rest.php");

// Add TextKey Session Handler
require_once("textkeysite.php");

// Create the session handling object
$textkeysite = new textkeysite();

// Check to make sure pass 1 worked (i.e. username/pasword authentication)
$loggedIn = $textkeysite->getPassedLoginCheck();
if ($loggedIn) {
	// Get the session values from the textkey validation and check to make sure they are good
	$textkeyvc = $textkeysite->get_textkeyvc();
	$tkuserId = $textkeysite->get_tkuserId();
	$textkey = $textkeysite->get_textkey();
	
	// Create the textkey object
	$tk = new textKey(TK_API);
	
	// Validate the TextKey to ensure it was the original one with the TextKey validation code
	$textkey_result = $tk->perform_ValidateTextKeyFromUserId($tkuserId, $textkey, $textkeyvc, TK_ISHASHED);
	if ($textkey_result->errorDescr === "") {
		// Check for an error
		$validationErrors = $textkey_result->validationErrors;
		foreach($validationErrors as $key => $value) { 
			switch ($value) {
				case "textKeyNoError":
					// No error so setup the return payload
					$error_msg = '({"error":"", "validated":' . json_encode($textkey_result->validated) . '})';

					// Handle setting the sesssion info.
					$textkeysite->setPassedTKCheck();
				break;
				case "textKeyNotFound":
					$error_msg = '({"error": "The TextKey sent was not valid."})';
				break;
				case "textKeyNotReceived":
					$error_msg = '({"error": "The TextKey was never received."})';
				break;
				case "textKeyFraudDetect":
					$error_msg = '({"error": "Fraud Detected - The TextKey was not sent by the authorized device."})';
				break;
				case "noRegistrationFound":
					$error_msg = '({"error": "The TextKey was received but it was not assigned to a registered user."})';
				break;
				case "validationCodeInvalid":
					$error_msg = '({"error": "The TextKey was received but the validation code was invalid."})';
				break;
				case "textKeyTooOld":
					$error_msg = '({"error": "The TextKey was received but had already expired."})';
				break;
				case "textKeyError":
					$error_msg = '({"error": "An innternal TextKey error occured."})';
				break;
				case "textKeyNotValidated":
					$error_msg = '({"error": "The TextKey was not validated."})';
				break;
				case "pinCodeError":
					$error_msg = '({"error": "A Pin Code error occured."})';
				break;
				default:
					$error_msg = '({"error": "An error occured while trying to verify the TextKey."})';
				break;
			}
		} 			
	}
	else {
		$error_msg = $textkey_result->errorDescr;
		$error_msg = '({"error":' . json_encode($error_msg) . '})';
	}
}
else {
	$error_msg = "Error logging in user: User/Password validation was not finalized.";		
	$error_msg = '({"error":' . json_encode($error_msg) . '})';
}

error_log('error_msg: ' . $error_msg);

echo $error_msg;

exit;

?>