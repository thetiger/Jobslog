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

if(!$_SESSION['username'] && !$_SESSION['id']){
session_destroy();
header('Location: checkpoint.php');	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jobslog System - Home</title>
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
<p>Welcome back, <?php echo infograb::grabinfo($_SESSION['id'],"fname"); ?> <?php echo infograb::grabinfo($_SESSION['id'],"lname"); ?>.</p>
<p>Your username is: <?php echo $_SESSION['username']; ?></p>
<p>This is our jobs panel you have currently applied for: <?php echo db::nRowsSQL("SELECT * FROM jobslog WHERE username = '".db::mss($_SESSION['username'])."'"); ?> jobs</p>
<p>Your work coach is: <?php echo infograb::grabinfo($_SESSION['id'],"workcoachemail"); ?></p>
<p>Login from host: <?php echo gethostbyaddr($_SERVER['REMOTE_ADDR']); ?></p>
<p>Login from IP: <?php echo $_SERVER['REMOTE_ADDR']; ?></p>
<p>Server Time: <span id=tick2>
</span>

<script>
<!--

/*By JavaScript Kit
http://javascriptkit.com
Credit MUST stay intact for use
*/

function show2(){
if (!document.all&&!document.getElementById)
return
thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
var Digital=new Date()
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
var dn="PM"
if (hours<12)
dn="AM"
if (hours>12)
hours=hours-12
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
var ctime=hours+":"+minutes+":"+seconds+" "+dn
thelement.innerHTML="<div style='font-size:12; color:000;'>"+ctime+"</div>"
setTimeout("show2()",1000)
}
window.onload=show2
//-->
</script></p>
<p><?php
$mtime = microtime(); 
   $mtime = explode(" ",$mtime); 
   $mtime = $mtime[1] + $mtime[0]; 
   $endtime = $mtime; 
   $totaltime = ($endtime - $starttime); 
   echo "<br><br>This page was created in ".substr($totaltime, -1)." ms"; 

   ?></p>
</div>
</div>


</div>
</div>
</body>
</html>