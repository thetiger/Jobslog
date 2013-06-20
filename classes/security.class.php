<?php

class security
{
	public static function mysqlistring($input){
		$string = mysqli_real_escape_string(db::makeConnection(),$input);
		
		return $string;
		
		
	}
	
	
	
}



?>