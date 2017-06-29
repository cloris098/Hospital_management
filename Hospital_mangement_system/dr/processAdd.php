<?php
//include db configuration file
include_once('../lib/library.php');
if ($_SESSION['mtuid']==""){ header ('Location: ../.'); exit();}
if ($_SESSION['mtuid']==""){ header ('Location: ../.'); exit();}
if(isset($_POST['spname'])){ //saving patient sponsors record
		$spname= ucwords($_POST['spname']); $spid="MtZHPS".date('zhis');
		$query =mysql_query("INSERT INTO pat_spon VALUES 
     ('".$spid."','".$spname."','".$_POST['spdetail']."','".date('Y-m-d')."','active','".$_SESSION['logname']."',0)") or die(mysql_error());}
if(isset($_POST['categ_name'])){ //saving new product and service category
		$categ_name= ucwords($_POST['categ_name']);
		$query =mysql_query("INSERT INTO pro_categ VALUES 
            (0,'".$categ_name."','".date('Y-m-d')."','".$_SESSION['logname']."','active')") or die(mysql_error());} 
if(isset($_GET['pro_name'])){ //saving new product and service items
			//generate the product code
		$counter=mysql_query("select categ_id from pro_service where categ_id='".$_GET['pro_categ']."'") or die(mysql_error());
		$val=(mysql_num_rows($counter))+1;
	if ($val<10){$pro_code=$_GET['pro_categ'].'000'.$val;}
	elseif ($val<100){$pro_code=$_GET['pro_categ'].'00'.$val;}
	else {$pro_code=$_GET['pro_categ'].'0'.$val;}
		$pro_name= ucwords(html_entity_decode($_GET['pro_name']));
		$query =mysql_query("INSERT INTO pro_service VALUES 
 ('".$pro_code."','".$pro_name."','".$_GET['pro_cost']."','".date('Y-m-d')."','active','".$_GET['pro_categ']."',
 '".$_SESSION['logname']."')") or die(mysql_error());
 echo $_GET['pro_name']. ' record saved successfully...';
 }
?>