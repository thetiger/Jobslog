<?php
if(!defined('ACTIVE')) die();



class infograb{
	
	
public static function grabinfo($id,$field){
	$sql = db::query("SELECT ".db::mss($field)." FROM users WHERE id = '".db::mss($_SESSION['id'])."'");	
	
	if(db::nRows($sql) > 0){
	while($data = db::fetch($sql)){
		
		return $data[$field];
		
	}
		
		
		
	}
	
	
}

public static function jobs(){
$sql = db::query("SELECT * FROM jobslog WHERE username = '".db::mss($_SESSION['username'])."' ORDER BY id DESC");	
	
	if(db::nRows($sql) > 0){
	$count = 0;
	while($data = db::fetch($sql)){
	$count++;
	
	if($count > 1){
	echo '<div style="width: 940px; height: auto; float: left; display: table-cell; border: 1px solid #CCC; background-color:#ccc;">
<div style="width:140px; height:auto; float:left; display:table-cell; clear:left; font-size:10pt; color:#000; border:inherit;">'.$data['ref'].'</div>
<div style="width:140px; height:auto; float:left; display:table-cell; font-size:10pt; color:#000; border:inherit;">'.$data['company'].'</div>
<div style="width:200px; height:auto; float:left; display:table-cell; font-size:10pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whatidid'].'</div>
<div style="width:85px; height:auto; float:left; display:table-cell; font-size:10pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['date'].'</div>
<div style="width:120px; height:auto; float:left; display:table-cell; font-size:10pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whathappened'].'</div>
<div style="width:140px; height:auto; float:left; display:table-cell; font-size:10pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whenidonext'].'</div>
<div style="width:85px; height:auto; float:left; display:table-cell; font-size:10pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whendothis'].'</div>
</div>';
$count = 0;
}
else
{
$count++;
echo '<div style="width: 940px; height: auto; float: left; display: table-cell; border: 1px solid #CCC;">
<div style="width:140px; height:auto; float:left; display:table-cell; clear:left; font-size:10pt; color:#000; border:inherit;">'.$data['ref'].'</div>
<div style="width:140px; height:auto; float:left; display:table-cell; font-size:10pt; color:#000; border:inherit;">'.$data['company'].'</div>
<div style="width:200px; height:auto; float:left; display:table-cell; font-size:10pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whatidid'].'</div>
<div style="width:85px; height:auto; float:left; display:table-cell; font-size:10pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['date'].'</div>
<div style="width:120px; height:auto; float:left; display:table-cell; font-size:10pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whathappened'].'</div>
<div style="width:140px; height:auto; float:left; display:table-cell; font-size:10pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whenidonext'].'</div>
<div style="width:85px; height:auto; float:left; display:table-cell; font-size:10pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whendothis'].'</div>
</div>';
}
		
	}
	
		
		
	}
	
}

public static function jobs2(){
$sql = db::query("SELECT * FROM jobslog WHERE username = '".db::mss($_SESSION['username'])."'");	
	
	$var = '';
	if(db::nRows($sql) > 0){
	$var  .= '<html><body>';
	$var .= '<style>
.main{
width: 600px; 
height: 40px; 
border: 1px solid #CCC;
display:table;
}
.company{
width:140px; 
height:auto; 
float:left;
font-size:12pt; 
color:#000;
border:inherit;
display:table-cell;
}
.whatidid{
width:200px; 
height:auto; 
float:left;
font-size:12pt; 
color:#000; 
border:inherit; 
word-wrap:break-word;
display:table-cell;
}
.date{
width:75px; 
height:auto; 
float:left; 
font-size:12pt; 
color:#000; 
border:inherit; 
word-wrap:break-word;
}
.whathappened{
width:120px; 
height:auto; 
float:left; 
font-size:12pt; 
color:#000;
border:inherit; 
word-wrap:break-word;
}
.whenidonext{
width:140px; 
height:auto; 
float:left;  
font-size:12pt; 
color:#000; 
border:inherit; 
word-wrap:break-word;
}
.whendothis{
width:75px; 
height:auto; 
float:left; 
font-size:12pt; 
color:#000; 
border:inherit; 
word-wrap:break-word;
}
</style><div class="main">';
	
while($data = db::fetch($sql)){

	$var .= '
<div class="company">'.$data['company'].'</div>
<div class="whatidid">'.$data['whatidid'].'</div>
<div class="date">'.$data['date'].'</div>
<div class="whathappened">'.$data['whathappened'].'</div>
<div class="whenidonext">'.$data['whenidonext'].'</div>
<div class="whendothis">'.$data['whendothis'].'</div>';

}
$var .= '</div></body></html>';
		
	}
	return $var;
	
	
}

public static function jobs3(){
$sql = db::query("SELECT * FROM jobslog WHERE username = '".db::mss($_SESSION['username'])."' AND flag = '' ORDER BY id DESC");	
	
	if(db::nRows($sql) > 0){
	$var = '<html><body><p>This email comes from the jobslog website bot, listed are all the jobs by the person named.</p><p>From Host: '.$_SERVER['REMOTE_ADDR'].'</p><p>Name: '.self::grabinfo($_SESSION['id'],'fname').' '.self::grabinfo($_SESSION['id'],'lname').'</p>
	<p>Date: '.date('l jS \of F Y h:i:s A', time()).'</p><p>Total jobs listed: '.db::nRows($sql).'</p>
	<div style="width: 940px; height: auto; float: left; display: table-cell; border: 1px solid #CCC;">
<div style="width:140px; height:auto; float:left; display:table-cell; clear:left; font-size:12pt; color:#000; border:inherit;">Jobs ref:</div>
<div style="width:140px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit;">Company</div>
<div style="width:200px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit;">What I did</div>
<div style="width:85px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit;">Date</div>
<div style="width:120px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit;">What happened</div>
<div style="width:140px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit;">What I will do next.</div>
<div style="width:85px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit;">When</div>
</div>';
$count = 0;
	while($data = db::fetch($sql)){
	$count++;
	
	if($count > 1){
	$var .= '<div style="width: 940px; height: auto; float: left; display: table-cell; border: 1px solid #CCC; background-color:#ccc;">
<div style="width:140px; height:auto; float:left; display:table-cell; clear:left; font-size:12pt; color:#000; border:inherit;">'.$data['ref'].'</div>
<div style="width:140px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit;">'.$data['company'].'</div>
<div style="width:200px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whatidid'].'</div>
<div style="width:85px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['date'].'</div>
<div style="width:120px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whathappened'].'</div>
<div style="width:140px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whenidonext'].'</div>
<div style="width:85px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whendothis'].'</div>
</div>';
$count = 0;
}
else
{
$count++;
$var .= '<div style="width: 940px; height: auto; float: left; display: table-cell; border: 1px solid #CCC;">
<div style="width:140px; height:auto; float:left; display:table-cell; clear:left; font-size:12pt; color:#000; border:inherit;">'.$data['ref'].'</div>
<div style="width:140px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit;">'.$data['company'].'</div>
<div style="width:200px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whatidid'].'</div>
<div style="width:85px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['date'].'</div>
<div style="width:120px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whathappened'].'</div>
<div style="width:140px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whenidonext'].'</div>
<div style="width:85px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whendothis'].'</div>
</div>';
}
	}
	return $var.'</body></html>';
	}
	
}

public static function jobs4(){
$sql = db::query("SELECT * FROM jobslog WHERE username = '".db::mss($_SESSION['username'])."' ORDER BY id DESC");	
	
	if(db::nRows($sql) > 0){
	$var = '<html><body><p>This Jobslog was Generated by the jobslog website bot, listed are all the jobs by the person named.</p><p>From Host: '.$_SERVER['REMOTE_ADDR'].'</p><p>Name: '.self::grabinfo($_SESSION['id'],'fname').' '.self::grabinfo($_SESSION['id'],'lname').'</p>
	<p>Date: '.date('l jS \of F Y h:i:s A', time()).'</p><p>Total jobs listed: '.db::nRows($sql).'</p>
	<div style="width: 940px; height: auto; float: left; display: table-cell; border: 1px solid #CCC;">
<div style="width:140px; height:auto; float:left; display:table-cell; clear:left; font-size:12pt; color:#000; border:inherit;">Jobs ref:</div>
<div style="width:140px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit;">Company</div>
<div style="width:200px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit;">What I did</div>
<div style="width:85px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit;">Date</div>
<div style="width:120px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit;">What happened</div>
<div style="width:140px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit;">What I will do next.</div>
<div style="width:85px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit;">When</div>
</div>';
	while($data = db::fetch($sql)){
	
	$var .= '<div style="width: 940px; height: auto; float: left; display: table-cell; border: 1px solid #CCC;">
<div style="width:140px; height:auto; float:left; display:table-cell; clear:left; font-size:12pt; color:#000; border:inherit;">'.$data['ref'].'</div>
<div style="width:140px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit;">'.$data['company'].'</div>
<div style="width:200px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whatidid'].'</div>
<div style="width:85px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['date'].'</div>
<div style="width:120px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whathappened'].'</div>
<div style="width:140px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whenidonext'].'</div>
<div style="width:85px; height:auto; float:left; display:table-cell; font-size:12pt; color:#000; border:inherit; word-wrap:break-word;">'.$data['whendothis'].'</div>
</div>';
	}
	return $var.'</body></html>';
	}
	
}

public static function sitestats($table){
$sql = db::query("SELECT * FROM ".db::mss($table)."");

return db::nRows($sql);

}

public static function convertdate($date){
return date('d-m-y', $date);

}

public static function graballuserdata($table){
$sql = db::query("SELECT * FROM ".db::mss($table)."");

if(db::nRows($sql) > 0){
$info = '';
$count = 0;
	while($data = db::fetch($sql)){
	$count++;
	
	if($count > 1){
$info .= '<tr>
						<td >
                            '.$data['id'].'
                        </td>
                        <td >
                            '.$data['fname'].'
                        </td>
                        <td>
                            '.$data['lname'].'
                        </td>
                        <td>
                            '.$data['loginip'].'
                        </td>
						<td>
                            '.substr($data['browser'], -0, 11).'
                        </td>
                    </tr>';
$count = 0;
}
else
{
$count++;
$info .= '<tr>
						<td >
                            '.$data['id'].'
                        </td>
                        <td >
                            '.$data['fname'].'
                        </td>
                        <td>
                            '.$data['lname'].'
                        </td>
                        <td>
                            '.$data['loginip'].'
                        </td>
						<td>
                            '.substr($data['browser'], -0, 11).'
                        </td>
                    </tr>';
}

}
return $info;
}
}

}
?>