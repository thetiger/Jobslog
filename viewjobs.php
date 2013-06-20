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

if(isset($_GET['download'])){
require_once("dompdf-master/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(infograb::jobs3());
$dompdf->render();
$dompdf->stream("sample.pdf");
}

if(!$_SESSION['username']){
session_destroy();
header('Location: checkpoint.php');	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jobslog System - View jobs applied for: <?php echo db::nRowsSQL("SELECT * FROM jobslog WHERE username = '".db::mss($_SESSION['username'])."'"); ?></title>
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
<p>Here, you can view jobs applied for and when.</p>
<div style="width: 940px; height: auto; float: left; display: table-cell; border: 1px solid #CCC;">
<div style="width:140px; height:auto; float:left; display:table-cell; clear:left; font-size:11pt; color:#000; border:inherit;">Jobs ref:</div>
<div style="width:140px; height:auto; float:left; display:table-cell; font-size:11pt; color:#000; border:inherit;">Company</div>
<div style="width:200px; height:auto; float:left; display:table-cell; font-size:11pt; color:#000; border:inherit;">What I did</div>
<div style="width:85px; height:auto; float:left; display:table-cell; font-size:11pt; color:#000; border:inherit;">Date</div>
<div style="width:120px; height:auto; float:left; display:table-cell; font-size:11pt; color:#000; border:inherit;">What happened</div>
<div style="width:140px; height:auto; float:left; display:table-cell; font-size:11pt; color:#000; border:inherit;">What I will do next.</div>
<div style="width:85px; height:auto; float:left; display:table-cell; font-size:11pt; color:#000; border:inherit;">When</div>
</div>
<?php
echo infograb::jobs();

?>
<br>
<a href="emailsend.php">Email to workcoach</a> - <a href="print.php">Print Data</a>
<?php
$mtime = microtime(); 
   $mtime = explode(" ",$mtime); 
   $mtime = $mtime[1] + $mtime[0]; 
   $endtime = $mtime; 
   $totaltime = ($endtime - $starttime); 
   echo "<br><br>This page was created in ".substr($totaltime, -1)." ms"; 
   ?>



</div>

</div>


</div>
</div>
</body>
</html>