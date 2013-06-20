<?php
//email system v1.0
session_start();
require('core.php');
require('classes/db.class.php');
require('classes/security.class.php');
require('classes/accounts.class.php');
require('classes/grabinfo.class.php');
require('globals.php');

$to      = infograb::grabinfo($_SESSION['id'],'workcoachemail');
$subject = $sitesubject;
$message = infograb::jobs3();
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

// More headers
$headers .= 'From: '.infograb::grabinfo($_SESSION['id'],'fname').' '.infograb::grabinfo($_SESSION['id'],'lname').'<'.infograb::grabinfo($_SESSION['id'],'workcoachemail').'>' . "\r\n";


mail($to, $subject, $message, $headers);
db::query("INSERT INTO `events` (`eventname`, `username`, `date`, `ip`) VALUES ('User sent workcoach email.', '".db::mss($_SESSION['username'])."', '".db::mss(time())."', '".db::mss($_SERVER['REMOTE_ADDR'])."')");

echo 'Jobslog Sent to email: '.infograb::grabinfo($_SESSION['id'],'workcoachemail');
echo '<META HTTP-EQUIV="refresh" CONTENT="10;URL=viewjobs.php">';
db::query("UPDATE  `jobslog` SET  `flag` =  '1' WHERE  `flag` = '' AND username = '".db::mss($_SESSION['username'])."'");


?>