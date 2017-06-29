<?php
include_once('../lib/library.php');
if ($_SESSION['mtuid']==""){ header ('Location: ../.'); exit();}
if(isset($_POST['spname'])){ 
	$spname= mysql_real_escape_string(ucwords($_POST['spname']));$spid=$_POST['spid'];$spdetail=$_POST['spdetail'];
	$query=mysql_query("Update pat_spon set sp_name='".$spname."',inputter='".$_SESSION['logname']."',sp_details='".$spdetail."',
	status='active' where sp_id='".$spid."'") or die(mysql_error());} 

if(isset($_POST['ecateg_id'])){ //updating product and service category
		$query=mysql_query("Update pro_categ set categ_name='".ucwords($_POST['ecateg_name'])."',
		inputter='".$_SESSION['logname']."',status='active' where categ_id='".$_POST['ecateg_id']."' ") or die(mysql_error());} 

if(isset($_GET['epro_id'])){ //saving new product and service items
		$pro_name= ucwords($_GET['epro_name']);
		$query =mysql_query("Update pro_service set pro_name='".$pro_name."',pro_cost='".$_GET['epro_cost']."',
		status='active',categ_id='".$_GET['epro_categ']."',inputter='".$_SESSION['logname']."' 
		where pro_code='".$_GET['epro_id']."'") or die(mysql_error());
 		echo $_GET['epro_name']. ' record updated successfully...';}

?>