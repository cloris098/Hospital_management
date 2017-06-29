<?php
include_once('../lib/library.php');
if ($_SESSION['mtuid']==""){ header ('Location: ../.'); exit();}
if(isset($_POST['pid'])){ //deleting patient problem...
		$pid=$_POST['pid'];
		$query =mysql_query("Update problem_type set status='nactive',inputter='".$_SESSION['logname']."'
		 where prob_id='".$pid."'") or die(mysql_error());} 
if(isset($_POST['patdelete'])){ //deleting patient data...
		$pid=$_POST['patid'];
//		$pid='MtZH140804';
		$delquery =mysql_query("Update patients set status='nactive',inputter='".$_SESSION['logname']."'
		 where p_id='".$pid."'") or die(mysql_error());} 
		 
if(isset($_POST['regid'])){ //deleting patient attendance
		$regquery =mysql_query("delete from pat_attendance where attend_id='".$_POST['regid']."'") or die(mysql_error());} 

?>