<?php
include_once("config.php");
require_once("textkeysite.php");

// Setup
$loggedIn = false;
$userName = "";

// Create the session handling object
$textkeysite = new textkeysite();

// Check to see if the user has fully logged in by passing both checks and then handle the custom code
$loggedIn = $textkeysite->getPassedTKCheck();
if ($loggedIn) {
	$userName = $textkeysite->get_userName();
};

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
    <title>TextKey Tutorial Login</title>
    <!-- Basic styling -->
    <link type='text/css' rel="stylesheet" href="css/textkey.css">

    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    
    <!-- TextKey JS Include to manage the Login Form -->
    <script type="text/javascript" src="js/login.js"></script>
    
    <!-- SimpleModal jQuery Include - Used for modal display -->
    <script type="text/javascript" src="js/jQuery.simplemodal-1.4.4.js"></script>
    
    <!-- TextKey JS Include to handle Polling -->
    <script type="text/javascript" src="js/textkey.js"></script>
    
    <!-- TextKey JS Include to customize the TextKey modal and callback handlers -->
    <script type="text/javascript" src="js/textkey_custom.js"></script>
</head>
<body>
<?php if (!($loggedIn)): ?>
    <form class="form-textkey" id="form-textkeygotologin" action="tutoriallogin.php" method="post">
      <p>
        <input type="submit" name="submit" value="Go To Login Page" class='login-send'>
      </p>
    </form>
<?php else: ?>
	<header>
        <h1><a href="index.php">TextPower - TextKey™ Demo Registraton</a></h1>
        <div class="tagdesc">
        	<br />
            <h1 align="center"><strong>SUCCESS!</strong></h1>
            <br />
            <h3 align="center">You have logged in with the user name <strong><?php echo $userName; ?></strong></h3>
            <br />
            <h2 align="center">If this was your company's website you would now be successfully logged in.</h2>
        </div>
	</header>
    <form class="form-textkey" id="form-textkey">
      <p>
        <input type="submit" name="submit" value="Logout" class='logout-send' onClick="return login.handlelogout(true);">
      </p>
    </form>
    <div class="tagdesc">
        <h3 align="center">Want to try this again?  Click the <strong>"Logout"</strong> button.</h3>
        <br />
    </div>
<?php endif; ?>
</body>
</html>
