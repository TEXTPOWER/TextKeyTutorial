TextKey Tutorial PHP Site
=========================

This TextKey Tutorial PHP Site provides an example of how to implement login using the TextKey REST API.

You can find a functioning version of this Tutorial Site Demo at [TextKey Tutorial Site](http://developer.textkey.com/tutorial_demo/). Please feel free to try it out.

Configuration Settings
----------------------

The Tutorial Site configuration file is called `config.php`. The only item you will need to setup for the Tutorial Site is your API Key. Just replace `YOUR_API_KEY` with your actual TextKey API Key:

```php
/*
** TextKey Settings
*/
define('TK_API', 'YOUR_API_KEY');
define('TK_DISPLAY_API', TK_API);
```
**NOTE:** You can get a developer API Key by going to the TextKey developer site at [TextKey Developer Site Registration](http://developer.textkey.com/register.php) and registering for an account. Once you have created an account and are logged in, you can get a Developer API Key by going to the user settings page (in the user menu on the upper left) and following the instructions on the `API Information` tab.

How the tutorial works 
----------------------

There is a full explanation of how this package works at [TextKey Tutorial](http://localhost/textkey/developersite/apitextkeytutorials.php). You can find a breakdown of how the Tutorial works broken down into steps with details on each step.

More Information
----------------

To get more detailed information on the TextKey API Services or to investigate the API in more detail, you can refer to the following:

* [TextKey Developer Site](http://developer.textkey.com)
* [TextKey API Call Documentation](http://developer.textkey.com/apidocumentation.php)
* [Test All TextKey API Calls](http://developer.textkey.com/apitestapicalls.php)
* [TextKey Sample Site](http://developer.textkey.com/apitextkeyexample.php)

Contributing to this Tutorial Site
----------------------------------

**Issues**

Please discuss issues and features on Github Issues. We'll be happy to answer to your questions and improve the Tutorial Site based on your feedback.

**Pull requests**

You are welcome to fork this Tutorial Site and to make pull requests on Github. We'll review each of them, and integrate in a future release if they are relevant.
