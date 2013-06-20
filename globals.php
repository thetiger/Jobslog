<?php
if(!defined('ACTIVE')) die();

if(isset($_GET['logout'])){
	accounts::logout();
	
	
}

if(!$_SESSION['username'] && !$_SESSION['id']){
session_destroy();
header('Location: checkpoint.php');	
}

$siteemail = 'jonathonmaguire@gmail.com';
$sitesubject = "Jobslog Bot - Jobslog Sheet";
$job = true;
$date = date_default_timezone_set('Europe/London');

?>