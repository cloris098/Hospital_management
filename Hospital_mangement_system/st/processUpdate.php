<?php
//include db configuration file
include_once('../lib/library.php');
if ($_SESSION['mtuid']==""){ header ('Location: ../.'); exit();}
if(isset($_POST['user_id'])){ //update user
$query =mysql_query("update s_users set uname='".$_POST['user_name']."',logname='".$_POST['log_name']."',
 p_id='".$_POST['p_name']."' where userid='".$_POST['user_id']."'") or die(mysql_error());}

if(isset($_POST['pname'])){ //update profile
	$pname= ucwords($_POST['pname']);$pid=$_POST['pid']; $timeout=$_POST['timeouts']*60000;
	$query=mysql_query("Update s_profile set p_name='".$pname."',inputter='".$_SESSION['logname']."',
	status='active',logtime='".$timeout."' where p_id='".$pid."'") or die(mysql_error());} 

?>