<?php

/*
 *@Product: DizzyArcade.com Flash Games Arcae
 *@Author: Shaun Childerley
 *@Founded: 31st December 2012
 *@Timestamp: December 31, 2012 8:23 PM
 *@Support: shaun@childerley.me
 *@File: db.class.php
 *@Description: db.class.php is designed to connect to our database as quickly and easily as possible.. it will be made static so we
 				dont have "global" problems inside other functions.
*/

if(!defined('ACTIVE')) die();

class db {
	
	//Lets make a connection here.
	public static function makeConnection() {
		return mysqli_connect('dbhost','dbuser','dbpasshere','dbdatabasename');
		// check connection
	}
	
	//End Connection
	public static function endConnection() {
		return mysqli_close(self::makeConnection());
		
		//Close Connection
		self::endConnection();	
	}
	
	//Lets make any mysql querys here.
	public static function query($sql) {
		return mysqli_query(self::makeConnection(), $sql);	
		
		//Close Connection
		self::endConnection();
	}
	
	//Lets fetch any SQL statements here.
	public static function fetch($sql) {
		return mysqli_fetch_array($sql);
		
		//Close Connection
		self::endConnection();	
	}
	
	//Lets query and fetch SQL statements here.
	public static function fetchQuery($sql) {
		return self::fetch(self::query($sql));
		
		//Close Connection
		self::endConnection();	
	}
	
	//Any num_rows() SQL statements to run?
	public static function nRowsSQL($sql) {
		return mysqli_num_rows(self::query($sql));

		//Close Connection
		self::endConnection();
	}
	
	//Any num_rows() querys?
	public static function nRows($sql) {
		return mysqli_num_rows($sql);

		//Close Connection
		db::endConnection();
	}
	
	//MYSQL Real Escape, protects SQL statements from injection.
	public static function mss($sql) {
		return mysqli_real_escape_string(db::makeConnection(), $sql);

		//Close Connection
		db::endConnection();
	}
}
?>