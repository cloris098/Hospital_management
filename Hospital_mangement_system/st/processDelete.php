<?php
include_once('../lib/library.php');
if ($_SESSION['mtuid']==""){ header ('Location: ../.'); exit();}
if(isset($_POST['action'])){
		$user_id=$_POST['user_id'];
		$query =@mysql_query("Update s_users set status='nactive' where userid='$user_id'") or die(mysql_error());}
if(isset($_POST['pname'])){
		$pname= ucwords($_POST['pname']);$pid=$_POST['pid'];
		$query =@mysql_query("Update s_profile set status='nactive' where p_id='".$pid."'") or die(mysql_error());} 

?>