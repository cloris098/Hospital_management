<?php
include_once ('../lib/library.php');
if ($_SESSION['mtuid']==""){ 
 header ('Location: ../.');
    exit();}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Password Change</title>
<!-- Required header files -->
<script type="text/javascript" src="js/jquery_1.5.2.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css">

</head>
<form action='.' method='post' class="form-inline">
<body onload="StartTimers();" onmousemove="ResetTimers();" onmousedown="disablecopy();" oncontextmenu="return false" oncopy="return false" onpaste="return false" oncut="return false">
<center>
<div style=" font-family:Verdana, Geneva, sans-serif; font-size:24px;">Change Of Password!</div><br clear="all" /><br clear="all" />
<div style="" id="vasplus_programming_blog_wrapper">
<center><?php
if(isset($_POST['index'])){
$usid=$_POST['uid']; $pwdo=$_POST['pwd1']; $pwdc=$_POST['pwd2'];
if(empty($usid) || empty($pwdo) || empty($pwdc)){
	echo "<div class='info'><font color='red'>All fields are required!</font></div>";
	} elseif($_SESSION['passwd']!=md5($_POST['curpwd'])){
		echo "<div class='info'><font color='red'>Your current password is invalid. Please make sure you type your current password correctly!</font></div>";	}
		 elseif(strlen($pwdo)<6){
	echo "<div class='info'><font color='red'>Sorry, your password does not meet password complexity requirements!</font></div>";
	}
	 elseif($pwdo!=$pwdc){
	echo "<div class='info'><font color='red'>Desired Password & Confirm Password does not match!</font></div>";
	}	else{  
		$pwdo=md5($pwdo);
$rs=@mysql_query("update s_users set passwd='$pwdo',reset='n' where userid='$usid'");
if (!$rs){ //means no credentials found or user profile is deactived!
    echo "<div class='info'><font color='red'>Unable to change password. Please contact your System Administrator.</font></div>";
	exit();}else {
        echo "<script>windows: location='../.'</script>"; }}} ?></center>

<div align="left" style ="float:left;font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold;">User Credentials</div><br clear="all">
<br clear="all">
<input type="hidden" name="uid" id="uid" readonly="readonly" value="<?php echo $_SESSION['mtuid']; ?>"/>
<div class="vpb_lebels" align="left">Name:</div>
<div class="vpb_lebels_fields" align="left">
<input type="text" name="usname" id="usname" readonly="readonly" value="<?php echo $_SESSION['usname']; ?>" class="vasplus_blog_form_opt" /></div><br clear="all"><br clear="all">

<div class="vpb_lebels" align="left">Current Password:</div>
<div class="vpb_lebels_fields" align="left">
<input type="password" required="required" name="curpwd" id="curpwd" class="vasplus_blog_form_opt" /></div><br clear="all"><br clear="all">

<div class="vpb_lebels" align="left">Desired Password:</div>
<div class="vpb_lebels_fields" align="left">
<input type="password" required="required" name="pwd1" id="pwd1" class="vasplus_blog_form_opt" /></div><br clear="all"><br clear="all">

<div class="vpb_lebels" align="left">Confirm Password:</div>
<div class="vpb_lebels_fields" align="left">
<input type="password" required="required" name="pwd2" id="pwd2" class="vasplus_blog_form_opt" /></div><br clear="all"><br clear="all">
<br clear="all">
<div class="vpb_lebels" align="left">&nbsp;</div>
<div style="width:600px;float:left;" align="left">
<button type="submit" name="index" class="vpb_general_button">Change Password</button>
<a href="../." class="vpb_general_button">Goto Log-in Page</a>
</div><br clear="all">
<br clear="all">


</div>
</center>
</form>
</body>
</html>