<?php
include_once('../lib/library.php');
if ($_SESSION['mtuid']==""){ header ('Location: ../.'); exit();}
if(isset($_POST['spid'])){ //deleting data...
		$spid=$_POST['spid'];
		$query =mysql_query("Update pat_spon set status='nactive',inputter='".$_SESSION['logname']."'
		 where sp_id='".$spid."'") or die(mysql_error());} 
if(isset($_POST['dcateg_id'])){ //deleting product and service category
		//$dcateg_id= ucwords($_POST['dcateg_id']);
		$query =mysql_query("Update pro_categ set status='nactive',inputter='".$_SESSION['logname']."' 
		where categ_id='".$_POST['dcateg_id']."' ") or die(mysql_error());} 
if(isset($_GET['dpro_id'])){ //delete product and service items
		$query =mysql_query("Update pro_service set status='nactive',inputter='".$_SESSION['logname']."' 
		where pro_code='".$_GET['dpro_id']."'") or die(mysql_error());
 		echo $_GET['dpro_name']. ' record deleted successfully...';}
?>