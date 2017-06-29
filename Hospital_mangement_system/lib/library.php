<?php
session_start();
ob_start();
mysql_connect("localhost", "root", "@dmin") or die ("Oops! Server not connected"); // Connect to the host
mysql_select_db("hos_man") or die ("Oops! DB not connected"); // select the database
$_SESSION['timeOut']=$_SESSION['logtime']; $_SESSION['maintimeOut']=$_SESSION['logtime']+300000; //1000ms=1secs
?>