<?php session_start();
mysql_connect("localhost", "root", "@dmin") or die ("Oops! Server not connected"); // Connect to the host
mysql_select_db("hos_man") or die ("Oops! DB not connected"); // select the database
include_once ('logout.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="images/lg.png" rel="icon" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<title>Home | MtZH</title>
 <style type="text/css">
        div.col2 {float: left; width: 250px;padding: 10px; }
        div.col3 {width: 0.05px; border:1px solid #CCC; height: 230px;float: left;  }
        div.col4 {float: left; width: 300px; padding: 15px; }
    </style>
<script type="text/javascript">
	$(document).ready(function(){
		$('#index').click(function(){
			$('<div id="dvLoading"></div>');
		});
		$('#uname').focus(function(){
			$('#msg').remove();
		});
		$('#pwd').focus(function(){
			$('#msg').remove();
		});
	});
</script>
	<style>
#dvLoading{ background: url(images/loading.gif) no-repeat center center;
   height: 50px; width: 100px; position: fixed;z-index: 1000; left: 50%;top: 30%; margin: -25px 0 0 -25px;
}</style>
</head>
<body onload="StartTimers();" onmousemove="ResetTimers();" onmousedown="disablecopy();" oncontextmenu="return false" oncopy="return false" onpaste="return false" oncut="return false" onkeydown="return (event.keyCode != 116)">
	<!--<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
   <img src="images/lg.png" style="height: 30px;width: 25px" /><font style="font-family: garamond;font-size: 16px;"> GO Web Developers </font> 
      </div></div></div> -->
 <br clear="all"><center>
<form action='.' method='post' class="form-inline" >
 <?php
if(isset($_POST['index'])){
$uname=mysql_real_escape_string($_POST['uname']); $pwd=mysql_real_escape_string($_POST['pwd']);
if(empty($uname) || empty($pwd)){
	echo "<div id='msg' class='info'><font color='red'>Username & Password fields are required!</font></div>";
	}
		else{		
		  $pwd=md5($pwd);
$rs=@mysql_query("select userid,uname,p_id,logname,passwd,reset from s_users where logname='".$uname."' and passwd='".$pwd."'
  and status like 'active'") or die(mysql_error());
if (mysql_num_rows($rs)<1){ ?> <!--means no credentials found or user profile is deactived!-->
<script type="text/javascript">$('#dvLoading').remove();</script>
<div id='msg' class='info'><font color='red'>No record matched your credentials. Please make sure you have access to this system and you have provided the necessary login credentials.</font></div>
	<?php }	else { ?><div id="dvLoading"></div>	<?php
    $ds=mysql_fetch_array($rs);
    $_SESSION['mtuid']= $ds[0]; $_SESSION['usname']=$ds[1];$_SESSION['profid']=$ds[2];
    $_SESSION['passwd']=$ds[4];$res=$ds[5];$_SESSION['logname']=$ds[3];
	$query=mysql_query("select p_name,logtime,p_id from s_profile where p_id='".$_SESSION['profid']."'") or die(mysql_error());
	$prid=mysql_fetch_array($query); $_SESSION['profname']=$prid[0]; $_SESSION['logtime']=$prid[1]; $_SESSION['profid']=$prid[2];
        if($res=="y"){ //user is required to change password
            echo "<script>windows: location='pchge/.?userlog=$uname'</script>";
            exit();} else {	$date=date('zYmdHi');$_SESSION['logdate']=$date; 
			$_SESSION['app']='Mt || Today is: '.date('l, jS M, Y');
			 $_SESSION['ulog']=md5($_SESSION['mtuid'].$date); ?>
	<script>windows: location="menus?userlog=<?php echo md5($_SESSION['mtuid'].$date); ?>"</script> 
       <?php } }}  } ?>
<br clear="all"><br clear="all">
<div style="width: 650px;font-family: garamond; font-size:16px;" id="vasplus_programming_blog_wrapper">
<div class="" align="left" style="width:auto; float:left; ">
<img src="images/log.jpg" style="width: 15%; height: 15%;"/>User Login Page </div>
<br clear="all"><hr />
<div class="col2" ><img alt="" src="images/mt.png" style="width: 100px; height: 60px;" align="left" />
<p align="left"></p>
<p align="left">This application is designed to capture and manage all internal activities within the organization. Every system user have a role to play to manage the application.</p></div>
<div class="col3"></div>
<div class="col4"><div class="vpb_lebels_fields" align="left">Please complete the form below to login.</div>
<div class="vpb_lebels" align="left">Your Username *:</div>
<div class="vpb_lebels_fields" align="left">
<input type="text" id="uname" name="uname" required="required" class="vasplus_blog_form_opt" placeholder="Username" title="Username is required." /></div><br clear="all">
<div class="vpb_lebels" align="left">Your Password *:</div>
<div class="vpb_lebels_fields" align="left">
<input type="password" name="pwd" id="pwd" required="required" class="vasplus_blog_form_opt" placeholder="Your Password" title="Your password is required." /></div>
<div style="width:300px;float:left;" align="left">
<br/> <button type="submit" id="index" name="index" class="btn btn-info">Log-In</button><br />
<b>Usernames and passwords are case sensitive</b></div></div>
<br clear="all" /><br clear="all" />
<!--class="vpb_general_button"-->
</div>
</form>   </center>
<div style="font-family:Verdana, Geneva, sans-serif; font-size:11px;" align="center">
<div style="width:350px; border:1px solid #CCC; padding:10px;" align="center">
<b>Forward all complains to:</b><br />
Email: gowebdevelopers@gmail.com<br />
All rights reserved @ 2014 | GOWeb Corporation.<br />
<p>"Luck is what happens when preparation meets opportunity."</p>
</div>
<br />
</div>  

 

</body>
</html>
