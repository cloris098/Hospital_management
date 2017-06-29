<?php
//include db configuration file
include_once('../lib/library.php');
if ($_SESSION['mtuid']==""){ header ('Location: ../.'); exit();}
if(isset($_POST['uname'])){ //saving new created user
		$uname= ucwords($_POST['uname']);$logname=$_POST['logname'];
        $p_id=$_POST['p_id'];$passwd=md5($_POST['passwd']);$action=$_POST['action'];
$query =@mysql_query("INSERT INTO s_users (uname,logname,passwd,p_id,status,reset) VALUES 
            ('".$uname."','".$logname."','".$passwd."','".$p_id."','active','y')") or die(mysql_error());}
if(isset($_POST['pname'])){ //saving new user profile
		$pname= ucwords($_POST['pname']); $timeout=$_POST['timeout']*60000;
		$query =@mysql_query("INSERT INTO s_profile(p_id,p_name,inputter,status,logtime) VALUES 
            (0,'".$pname."','".$_SESSION['logname']."','active','".$timeout."')") or die(mysql_error());} 
if (isset($_POST['mid'])){
//delete all menus related to the selected profile
$query=mysql_query("delete from sp_menus where sp_id='".$_POST['pid']."'") or die(mysql_error());
	$cpid=count($_POST['mid']); $pid=$_POST['pid'];$mid=$_POST['mid'];$gid=$_POST['gid'];
	$i=0;
	for($i=0;$i<$cpid;$i++){//saving the profile menu array 
	$query=mysql_query("Insert into sp_menus (sp_id,sm_id,smg_id) values ('".$pid."',
	'".$mid[$i]."','".$gid[$i]."')") or die(mysql_error());			
	}
}

?>