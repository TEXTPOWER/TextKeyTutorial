<?php
	// Include configuration settings
	include_once("config.php");

	// Add TextKey PHP REST Library
	include_once("textkey_rest.php");
	
	// Get the params
	$textkey = $_REQUEST['textKey'];

	// Create a TK object
	$tk = new textKey(TK_API);
		
	// Handle the operation
	$textkey_result = $tk->perform_PollForIncomingTextKey($textkey);
	
	// Handle the results
	if ($textkey_result->errorDescr == "") {
		echo $_REQUEST['callback'].'('.json_encode($textkey_result).')';
	}
	else {
		echo $_GET['callback'] . "({\"error\":\"". $textkey_result->errorDescr ."\"})";
	}
?>