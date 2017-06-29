<?php
include_once('../lib/library.php');
if ($_SESSION['mtuid']==""){ header ('Location: ../.'); exit();}
if(isset($_POST['pname'])){
	$pname= ucwords($_POST['pname']);$pid=$_POST['pid'];
	$query=mysql_query("Update problem_type set problem='".$pname."',inputter='".$_SESSION['logname']."',
	status='active' where prob_id='".$pid."'") or die(mysql_error());} 

?>