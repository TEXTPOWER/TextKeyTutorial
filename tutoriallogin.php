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
    <form class="form-textkey" id="form-textkey" method="post">
      <h1>Login</h1>
      <p>
        <label for="login">Username</label>
        <input type="text" name="name" id='login-name' placeholder="Username">
      </p>
      <p>
        <label for="password">Password</label>
        <input type="password" name='password' id='login-password' placeholder="Password">
      </p>
      <p>
        <input type="submit" name="submit" value="Login" class='login-send' onClick="return login.handlelogin();">
      </p>
    </form>
</body>
</html>
