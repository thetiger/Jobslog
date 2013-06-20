<?php
session_start();
require('core.php');
require('classes/db.class.php');
require('classes/security.class.php');
require('classes/accounts.class.php');
require('classes/events.class.php');
require('safe.php');
$sitename = 'Jobslog';

define('EMAIL_FOR_REPORTS', 'jonathonmaguire@gmail.com');
define('RECAPTCHA_PRIVATE_KEY', '6LetXOISAAAAAL_6fMq1RDzIDEqLW-W6TeLPVGF9');
define('FINISH_URI', 'http://');
define('FINISH_ACTION', 'message');
define('FINISH_MESSAGE', 'Thanks for filling out my form!');
define('UPLOAD_ALLOWED_FILE_TYPES', 'doc, docx, xls, csv, txt, rtf, html, zip, jpg, jpeg, png, gif');

require_once('form_files/formoid1/handler.php');

if(isset($_POST['submitlogin'])){
	
	accounts::login($_POST['username'],$_POST['password']);
	echo 'hi';
	
	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jobslog System - Checkpoint</title>
<link rel="stylesheet" href="css/site.css" type="text/css"/>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="js/script.js"></script>
</head>

<body>
<div class="sitecontainer"><!-- This is the website container -->
<div class="container"><!-- This is the general container for data -->
<div class="topnav"><!-- This is the navigation at top which has logo and buttons -->
<div class="logo"><!-- Jobcentre Logo -->
<img src="http://workingfutures.interserve.com/images/global/logo.png" />
</div>


</div><!-- Nav End -->
<div style="float:left; clear:left; padding:5px; width:200px; height:auto; font-size:10pt; color:#000;">
<?php if (frmd_message()): ?>
<link rel="stylesheet" href="login_files/formoid1/formoid-default.css" type="text/css" />
<span class="alert alert-success"><?php FINISH_MESSAGE;?></span>
<?php else: ?>
<!-- Start Formoid form-->
<link rel="stylesheet" href="login_files/formoid1/formoid-default.css" type="text/css" />
<script type="text/javascript" src="login_files/formoid1/jquery.min.js"></script>
<form class="formoid-default" style="background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;width:250px" title="Login" method="post" action="checkpoint.php">
	<div class="element-text" ><h2 class="title">Login</h2></div>
	<div class="element-input"  <?php frmd_add_class("input")?>><label class="title">Username<span class="required">*</span></label><input type="text" name="username" required="required"/></div>
	<div class="element-password"  <?php frmd_add_class("password")?>><label class="title">Password<span class="required">*</span></label><input type="password" name="password" value="" required="required"/></div>
	<div class="element-submit"  title="Login to <?php echo $sitename; ?>"><input type="submit" name="submitlogin" value="Login"/></div>

</form>
<script type="text/javascript" src="login_files/formoid1/formoid-default.js"></script>

<p class="frmd"><a href="http://formoid.com/">Contact Form Popup Formoid.com 1.7</a></p>
<!-- Stop Formoid form-->
<?php endif; ?>
</div>

<div style="margin-left:10px; width:300px; height:auto; float:left;">
<?php if (frmd_message()): ?>
<link rel="stylesheet" href="form_files/formoid1/formoid-default.css" type="text/css" />
<span class="alert alert-success"><?php=FINISH_MESSAGE;?></span>
<?php else: ?>
<!-- Start Formoid form-->
<?php
if(isset($_POST['submitregistration'])){
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$passwordcheck = $_POST['password1'];
	$email = $_POST['email'];
	
	require_once('form_files/formoid1/recaptchalib.php');
	
	$resp = recaptcha_check_answer (RECAPTCHA_PRIVATE_KEY,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ")");
  } else {
    // Your code here to handle a successful verification
		accounts::registeruser($fname,$lname,$username,$password,$passwordcheck,$email);
  }
}
?>
<link rel="stylesheet" href="form_files/formoid1/formoid-default.css" type="text/css" />
<script type="text/javascript" src="form_files/formoid1/jquery.min.js"></script>
<form class="formoid-default" style="background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;width:480px" title="Register form" method="post">
	<div class="element-text"  title="Register with <?php echo $sitename; ?>"><h2 class="title">Register with <?php echo $sitename; ?></h2></div>
	<div class="element-input"  <?php frmd_add_class("input")?>><label class="title">Firstname<span class="required">*</span></label><input type="text" name="fname" required="required"/></div>
	<div class="element-input"  <?php frmd_add_class("input1")?>><label class="title">Lastname<span class="required">*</span></label><input type="text" name="lname" required="required"/></div>
	<div class="element-input"  title="Choose a username for <?php echo $sitename; ?>" <?php frmd_add_class("input2")?>><label class="title">Username</label><input type="text" name="username" /></div>
	<div class="element-password"  title="Choose a secure password" <?php frmd_add_class("password")?>><label class="title">Password<span class="required">*</span></label><input type="password" name="password" value="" required="required"/></div>
	<div class="element-password"  <?php frmd_add_class("password1")?>><label class="title">Re-enter Password<span class="required">*</span></label><input type="password" name="password1" value="" required="required"/></div>
	<div class="element-email"  title="Enter your email address" <?php frmd_add_class("email")?>><label class="title">Email<span class="required">*</span></label><input type="email" name="email" value="" required="required"/></div>
	<div class="element-recaptcha"  <?php frmd_add_class("captcha")?>><label class="title">reCAPTCHA</label><script type="text/javascript">var RecaptchaOptions = {theme : "clean"};</script>
<script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=6LetXOISAAAAANs29GbM1Hc2hYkBJYAuW89ugRxM&theme=clean"></script>
<noscript><iframe src="http://www.google.com/recaptcha/api/noscript?k=6LetXOISAAAAANs29GbM1Hc2hYkBJYAuW89ugRxM&hl=en" height="300" width="500" frameborder="0"></iframe></br>
<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea><input type="hidden" name="recaptcha_response_field" value="manual_challenge"></noscript>
<script type="text/javascript">if (/#invalidcaptcha$/.test(window.location)) (document.getElementById("recaptcha_widget_div")).className += " error"</script></div>
	<div class="element-submit" ><input type="submit" name="submitregistration" value="Submit"/></div>

</form>
<script type="text/javascript" src="form_files/formoid1/formoid-default.js"></script>

<p class="frmd"><a href="http://formoid.com/">Contact Form Popup Formoid.com 1.7</a></p>
<!-- Stop Formoid form-->
<?php endif; ?>
</div>

<div style="width:100%; height 70px; float:left; font-size:8pt; color:black; font-family:Tahoma; ">&copy; Jonathon Maguire 2013-2014, All rights reserved.</div>
</div>
</div>
</body>
</html>