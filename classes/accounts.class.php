<?php

if(!defined('ACTIVE')) die();

class accounts
{
	private $username;
	private $password;
	
	public static function producehash($password){
		
		return sha1(md5($password.'mxdxjq*WNFG1%A-%P7nxGXM6!5c88!vlNPkowQU*Q-alg1$rGM-AZyytvGtEt8Sk'));
	
	}

	public static function login($username,$password){
		$password = self::producehash($password);
	
		$sql = db::query("SELECT * FROM users WHERE username = '".db::mss($username)."' AND password = '".db::mss($password)."'");
	
			if(db::nRows($sql) > 0){
				while($data = db::fetch($sql)){
					db::query("INSERT INTO `events` (`eventname`, `username`, `date`, `ip`) VALUES ('User logged in', '".db::mss($data['username'])."', '".db::mss(time())."', '".db::mss($_SERVER[	'REMOTE_ADDR'])."')");
					$_SESSION['username'] = $data['username'];
					$_SESSION['id'] = $data['id'];
					$_SESSION['hash'] = self::generatehash();
					$_SESSION['admin'] = $data['admin'];
				    db::query("UPDATE users SET loginip = '".db::mss($_SERVER['REMOTE_ADDR'])."', checkhash = '".db::mss($_SESSION['hash'])."', browser = '".db::mss($_SERVER['HTTP_USER_AGENT'])."' WHERE username = '".db::mss($username)."'");
					header('Location: index.php');
					exit();
				}
			}
			else
			{
				session_destroy();
				header('Location: checkpoint.php');
				exit();
			}
		
	}
	
	public static function logout(){
	db::query("INSERT INTO `events` (`eventname`, `username`, `date`, `ip`) VALUES ('User logged out.', '".db::mss($_SESSION['username'])."', '".db::mss(time())."', '".$_SERVER['REMOTE_ADDR']."')");
	session_destroy();
	header('Location: index.php');	
		
	}
	
	public static function register(){
		echo 'true';
		
	}
	
	public static function checkinput($input){
	if(!$input){
	return true;	
		
	}
		
	}
	
	public static function checksame($input1,$input2){
	if($input1 == $input2){
	return true;	
		
	}
		
	}
	
	public static function generatehash(){
	
	$addr = $_SERVER['REMOTE_ADDR'];
	$browser = $_SERVER['HTTP_USER_AGENT'];
	$username = $_SESSION['username'];
	
	return sha1(md5($addr.$browser.$username.'L4l1sPRO(WZpkYh5&viTnB-px8OlkYM0c71XINmohIarLNhg1jqxDteBU6sLF6vs'));
	
	}
	
	public static function hashcheck($hash){
	$sql = db::query("SELECT * FROM users WHERE checkhash = '".db::mss($hash)."' AND username = '".db::mss($_SESSION['username'])."'");
	
	if(db::nRows($sql)>0){
	while($data = db::fetch($sql)){
	if($data['checkhash'] != $_SESSION['hash']){
	return false;
	}
	
	}
	
	
	}
	
	}
	
	public static function emailcheck($email){
	$sql = db::query('SELECT * FROM users WHERE email = "'.db::mss($email).'"');
	if(db::nRows($sql)>0){
	return true;
	}
	else
	{
	return false;
	}
	
	}
	
	public static function registeruser($fname,$lname,$username,$password,$passwordcheck,$email){
	$passwordfile = self::producehash($password);
	$passwordfile1 = self::producehash($passwordcheck);
	
	if($passwordfile == $passwordfile1){
	if(self::emailcheck($email) == false){
	$act = self::generateactivation();
	db::query("INSERT INTO `users` (`fname`, `lname`, `username`, `password`, `email`, `activatehash`) VALUES ('".db::mss($fname)."', '".db::mss($lname)."', '".db::mss($username)."', '".db::mss($passwordfile)."', '".db::mss($email)."', '".db::mss($act)."')");
	    //change this to your email. 
		$to = $email;
		

		$subject = 'Jobslog Registration';

		$headers = "From: " . strip_tags($email) . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		$message = file_get_contents('templates/register.tpl');
		$message = str_replace('<!--FIRSTNAME-->',$fname,$message);
		$message = str_replace('<!--LASTNAME-->',$lname,$message);
		$message = str_replace('<!--SITENAME-->','Jobslog System',$message);
		$message = str_replace('<!--ACTIVATIONHASH-->',$act,$message);
		$message = str_replace('<!--JOBSLOGSITE-->','www.jobslog.com staff',$message);
		$message = str_replace('<!--EMAIL-->',$email,$message);
		



		mail($to, $subject, $message, $headers); 
		echo "<span class=\"alert alert-success\">Register Successfull</span>";
	}
	else
	{
	echo 'Email exists';
	}
	}
	
	}
	
	public static function generateactivation(){
	$numbers = rand(300,500);
	$numbers = $numbers+$numbers;
	$browser = $_SERVER['HTTP_USER_AGENT'];
	
	return sha1(md5($numbers,$browser));
	
	
	}
	
	public static function activateaccount($email,$hash){
	$sql = db::query('SELECT * FROM users WHERE email = "'.db::mss($email).'" AND activatehash = "'.db::mss($hash).'"');
	
	if(db::nRows($sql)>0){
	db::query('UPDATE  `users` SET  `activatehash` =  "",`status` =  "1" WHERE  `email` = "'.db::mss($email).'" AND activatehash = "'.db::mss($hash).'"');
	echo 'Account active';
		$to = $email;
		$subject = 'Jobslog Account activation';

		$headers = "From: " . strip_tags($email) . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		$sql = db::query("SELECT * FROM users WHERE email = '".db::mss($email)."'");
		while($data = db::fetch($sql)){
		$fname = $data['fname'];
		$lname = $data['lname'];
		}
		$message = file_get_contents('templates/activate.tpl');
		$message = str_replace('<!--FIRSTNAME-->',$fname,$message);
		$message = str_replace('<!--LASTNAME-->',$lname,$message);
		$message = str_replace('<!--IP-->',$_SERVER['REMOTE_ADDR'],$message);
		$message = str_replace('<!--SITENAME-->','Jobslog System',$message);
		$message = str_replace('<!--JOBSLOGSITE-->','www.jobslog.com staff',$message);
		
		mail($to, $subject, $message, $headers);
		echo '<p>Activation Succesfull, <a href="index.php" title="Go Home">Click here to go home</a></p>';
	}
	else
	{
	echo 'no';
	}
	}
	
	
}
?>