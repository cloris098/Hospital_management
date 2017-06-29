<?php
//include db configuration file
include_once('../lib/library.php');
if ($_SESSION['mtuid']==""){ header ('Location: ../.'); exit();}
if(isset($_POST['pname'])){ //saving new user profile
		$pname= ucwords($_POST['pname']);
		$query =mysql_query("INSERT INTO problem_type(prob_id,problem,inputter,status,datecap) VALUES 
            (0,'".$pname."','".$_SESSION['logname']."','active','".date('Y-m-d')."')") or die(mysql_error());} 
		if ($query){echo "Problem saved successfully...";} else {echo mysql_error();}

?>