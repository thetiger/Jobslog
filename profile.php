<?php
session_start();
   $mtime = microtime(); 
   $mtime = explode(" ",$mtime); 
   $mtime = $mtime[1] + $mtime[0]; 
   $starttime = $mtime; 
require('core.php');
require('classes/db.class.php');
require('classes/security.class.php');
require('classes/accounts.class.php');
require('classes/grabinfo.class.php');
require('globals.php');

if(!$_SESSION['username']){
session_destroy();
header('Location: checkpoint.php');	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jobslog System - Profile Info</title>
<link rel="stylesheet" href="css/site.css" type="text/css"/>
</head>

<body>
<div class="sitecontainer"><!-- This is the website container -->
<div class="container"><!-- This is the general container for data -->
<div class="topnav"><!-- This is the navigation at top which has logo and buttons -->
<div class="logo"><!-- Jobcentre Logo -->
<img src="http://workingfutures.interserve.com/images/global/logo.png" />
</div>


</div>
<?php require('nav.php'); ?>
<div class="datacontainer">
<div class="data">
<p>Here details all personal information held on your account with us.</p>
<p>Your name: <?php echo infograb::grabinfo($_SESSION['id'],'fname'); ?> <?php echo infograb::grabinfo($_SESSION['id'],'lname'); ?></p>
<p>Your username: <?php echo infograb::grabinfo($_SESSION['id'],'username'); ?></p>
<p>Your e-mail address: <?php echo infograb::grabinfo($_SESSION['id'],'email'); ?></p>
<p>Your workcoach email: <?php echo infograb::grabinfo($_SESSION['id'],'workcoachemail'); ?></p>
<p><?php
$mtime = microtime(); 
   $mtime = explode(" ",$mtime); 
   $mtime = $mtime[1] + $mtime[0]; 
   $endtime = $mtime; 
   $totaltime = ($endtime - $starttime); 
   echo "<br>This page was created in ".substr($totaltime, -1)." ms"; 

   ?></p>
</div>
</div>


</div>
</div>
</body>
</html>