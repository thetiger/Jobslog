<?php

if(!defined('ACTIVE')) die();



class events
{
	public static function logevent($eventname){
		
	db::query("INSERT INTO events ('eventname', 'username', 'date')VALUES('".$eventname.", '".$_SESSION['username']."', '".time()."')");
		
	}
	
	
	
	
	
	
	
	
	
}



?>