<?php
session_start();
require('core.php');
require('classes/db.class.php');
require('classes/security.class.php');
require('classes/accounts.class.php');
require('classes/postjob.class.php');
require('globals.php');

function date_picker($name, $startyear=NULL, $endyear=NULL)
{
        $day = date("d");
        $month = date("m");
       
    if($startyear==NULL) $startyear = date("Y");
    if($endyear==NULL) $endyear=date("Y");
    $months=array('','January','February','March','April','May',
    'June','July','August', 'September','October','November','December');
    // Month
    $html="<select name=\"".$name."month\">";
 
    for($i=01;$i<=12;$i++)
    {
                if($i == $month){
                      $html.="<option selected value='$i'>$months[$i]</option>";
                }else $html.="<option value='$i'>$months[$i]</option>";
    }
    $html.="</select> ";
    // Day
    $html.="<select name=\"".$name."day\">";
    for($i=01;$i<=31;$i++)
    {
                if($i == $day){
                          $html.="<option selected value='$i'>$i</option>";
                }else $html.="<option value='$i'>$i</option>";
    }
    $html.="</select> ";
    // Year
    $html.="<select name=\"".$name."year\">";
    for($i=$startyear;$i<=$endyear;$i++)
    {      
      $html.="<option value='$i'>$i</option>";
    }
    $html.="</select> ";
       
    return $html;
}

if(isset($_POST['submitnewjobb'])){

$jobref = $_POST['jobref'];
$company = $_POST['company'];
$whatidid = $_POST['whatidid'];
$date = $_POST['date'];
$whathappened = $_POST['whathappened'];
$whatiwilldonext = $_POST['whatiwilldonext'];
$whendonext = $_POST['datenextmonth'].'-'.$_POST['datenextday'].'-'.$_POST['datenextyear'];
$date = $_POST['datemonth'].'-'.$_POST['dateday'].'-'.$_POST['dateyear'];

postjob::postjoblog($jobref,$company,$whatidid,$date,$whathappened,$whatiwilldonext,$whendonext);
	
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
<title>Jobslog System - Add Joblog</title>
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
<p>You can add jobs using this page, it will be directly inputted to the database.</p>
</div>
<div style="width: 400px; height: auto; float: left; display: table-cell; clear: left; font-size:10pt; color:#000;">
<fieldset>
<legend>Add Job</legend>
<form method="post" action="addjob.php">
<p>Jobs Ref:&nbsp;<input type="text" name="jobref" value=""></p>
<p>Company:&nbsp;<input type="text" name="company" value=""></p>
<p>What I did:&nbsp;<textarea style="width:300px; height:50px;" name="whatidid"></textarea></p>
<p>Date:&nbsp;<?php
echo date_picker("date","2013","2014");
?></p>
<p>What happened:&nbsp;<select name="whathappened"><option value="Sent email to company">Sent Email to company</option><option value="Applied via Universal Jobmatch">Applied via Universal Jobmatch</option><option value="Applied Via Reed">Applied Via Reed</option><option value="Applied Via Indeed">Applied Via Indeed</option><option value="Got Interview">Got Interview</option><option value="Had Phone Interview">Had Phone Interview</option><option value="Awaiting response">Awaiting response</option></select></p>
<p>What I will do next:&nbsp;<select name="whatiwilldonext"><option value="Send email to company">Send Email to company</option><option value="Phone up company">Phone up company</option><option value="Visit Company">Visit Company</option></select></p>
<p>When I will do this:&nbsp;<?php
echo date_picker("datenext","2013","2014");
?></p>
<p>Submit Job Record:&nbsp;<input type="submit" name="submitnewjobb" value="Add!"></p>
</form>
</fieldset>
</div>
</div>


</div>
</div>
</body>
</html>