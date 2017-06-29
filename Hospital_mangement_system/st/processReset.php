<?php
include_once('../lib/library.php');
if ($_SESSION['mtuid']==""){ header ('Location: ../.'); exit();}	
if(isset($_POST['user_id'])){
		$user_id=trim($_POST['user_id']);
        $pwd=md5($_POST['pwd']);
		$action=$_POST['action'];
	//	$user_id=mysql_real_escape_string(htmlentities($user_id));
$query =mysql_query("Update s_users set status='active',reset='y',passwd='".$pwd."' where userid='".$user_id."'") 
or die(mysql_error());
	
	}

?>