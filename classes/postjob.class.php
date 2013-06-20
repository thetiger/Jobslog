<?php
if(!defined('ACTIVE')) die();



class postjob
{
	public static function postjoblog($ref,$company,$whatidid,$date,$whathappened,$whenidonext,$whendothis){
		
		db::query("INSERT INTO `jobslog` (`username`, `ref`, `company`, `whatidid`, `date`, `whathappened`, `whenidonext`, `whendothis`) VALUES ('".db::mss($_SESSION['username'])."', '".db::mss($ref)."', '".db::mss($company)."', '".db::mss($whatidid)."', '".db::mss($date)."', '".db::mss($whathappened)."', '".db::mss($whenidonext)."', '".db::mss($whendothis)."')");
		header('Location: viewjobs.php');
		
	}
	
	
	
}






?>