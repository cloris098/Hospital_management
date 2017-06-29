<?php
include_once ('../lib/library.php');
if ($_SESSION['mtuid']==""){ 
 header ('Location: ../.');
    exit();} $pagename='lop'; $pagegroup='pi';	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>List of Patients</title>
<link rel="icon" href="../images/lg.png" />
<link href="../css/jquery-ui-1.10.0.custom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.css" type="text/css"/> 
<link rel="stylesheet" href="../css/jquery.qtip.min.css" type="text/css"/>
<link rel="stylesheet" href="../css/style.css" type="text/css" />
<link rel="stylesheet" href="../lib/screen.css" type="text/css" />
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/bootstrap.js" type="text/javascript"></script>
<script src="../js/jquery.dataTables.js" type="text/javascript"></script>
<script src="../js/DT_bootstrap.js" type="text/javascript"></script>
<script src="../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../js/jquery.qtip.min.js" type="text/javascript"></script>
<script src="js/patients.js" type="text/javascript" ></script>
<style>
#dvLoading{background: url(../images/loading.gif) no-repeat center center;
   height: 50px; width: 100px; position: fixed; z-index: 1000; left: 50%; top: 30%; margin: -25px 0 0 -25px;}</style>
  <script type="text/javascript">
$(document).ready(function(){ 
$('#dvLoading').fadeOut(1000);
	$('#pcrit').change(function(){
		$('#operand').val($('#pcrit option:selected').text());
		if ($('#operand').val()=='Contains'){
			$('#recname').attr('required','');
		} else {$('#recname').attr('required','required');}
		$('#recname').focus();
	});
	
	$('#ifind').click(function(){ 
	$('#reload_records').slideUp('fast');
	$('#vasplus_programming_blog_wrapper').slideDown('slow');
	});
});
  </script>
<?php include_once ('../lib/popclose.php'); ?>
</head>
<body style="background: white;" onload="StartTimers();" onmousemove="ResetTimers();" onmousedown="disablecopy();" oncontextmenu="return false" oncopy="return false" onpaste="return false" oncut="return false" onkeydown="return (event.keyCode != 116)">
<form action="<?php $_SERVER['PHP_SELF']; ?>" id="fname" method="post">
<input type="hidden" value="Contains" name="operand" id="operand" />
<h2 id="banner"><div style="width: auto; float: left;"><img src="../images/mt.png" style="width: 10%; height: 8%;"/>
WELCOME to: <?php echo $_SESSION['app']; ?> </div>	<br /> </h2><hr />
<div id="dvLoading"></div>
<div class="modal-header">
<div id="msg" style="width: auto;"></div>

    <div id="delete_patient" title="Delete Data">
        <div class="control-group">
        <label id="pname" class="control-label"></label>
            <div class="controls">
            <input type="hidden" name="id2" id="id2"/>
                    <input type="hidden" id="lb2" readonly="readonly" name="lb2"/></div></div></div> 

<div id="vasplus_programming_blog_wrapper" style="text-align: center; font-family:Times New Roman; font-size:16px;"><br />
<div align="left" style ="float:left;font-weight:bold;">
Find Patient Data:</div> <div class="vpb_lebels_fields" align="right">
<button id="find" name="find" type="submit" class="btn btn-primary" title="find record"><i class='icon-white icon-search'></i></button></div>
<br /><hr />
<div class="vpb_lebels" align="left" style ="float:left;">Criteria:</div>
<div class="vpb_lebels_fields" align="left">
<select name="pcrit" id="pcrit" class="vasplus_blog_form_opt">
	<option value="like">Contains</option>
	<option value="=">Equals</option>
	<option value="!=">Not Equals</option>
	<option value="like">Starts With</option>
	</select></div><br clear="all">
<div class="vpb_lebels" align="left" style ="float:left;">Name of Patient:</div>
<div class="vpb_lebels_fields" align="left">
<input type="text" name="recname" id="recname" placeholder="Enter Patient Name" class="vasplus_blog_form_opt" />
 </div><br clear="all"><br clear="all">
<br clear="all">
<div class="vpb_lebels" align="left">&nbsp;</div>
<br clear="all"></div>
<?php
 if (isset($_POST['refresh'])){ ?> <script>$('#vasplus_programming_blog_wrapper').slideUp('fast');</script> 
<?php goto dataRecords; exit();}
elseif (isset($_POST['find'])) { ?><script>$('#vasplus_programming_blog_wrapper').slideUp('fast');</script>
<div id="load_problem">
<?php  if (isset($_POST['recname']) && !empty($_POST['recname'])){ //load data when user posts problem by clicking find button
		if ($_POST['operand']=='Contains'){ 
$mydata = mysql_query("SELECT * from patients where concat(fname,' ',surname) 
 ".$_POST['pcrit']." '%".$_POST['recname']."%' order by concat(fname,' ',surname)") or die(mysql_error());	
		}elseif ($_POST['operand']=='Starts With'){ 
$mydata = mysql_query("SELECT * from patients where concat(fname,' ',surname) 
 ".$_POST['pcrit']." '".$_POST['recname']."%' order by concat(fname,' ',surname)") or die(mysql_error());	
		}else {
$mydata = mysql_query("SELECT * from patients where concat(fname,' ',surname) 
 ".$_POST['pcrit']." '".$_POST['recname']."' order by concat(fname,' ',surname)") or die(mysql_error()); }
 ?>
 <div class="info" id="pop">Records for Patients that <?php  echo $_POST['operand'].': '. $_POST['recname']; ?></div> <br />
<?php }else { //load data when user click refresh to load all records
	dataRecords:
$mydata = mysql_query("SELECT * from patients where status like 'active' order by concat(fname,' ',surname)") or die(mysql_error());}?> 
 <div id="reload_records">
<!--<a id="add_pro" class="btn btn-primary" title="add new data" href="#"><i class='icon-white icon-plus'></i></a>-->
<button id="refresh" name="refresh" type="submit" class="btn btn-primary" title="refresh form"><i class='icon-white icon-refresh'></i></button>
<!--<a id="refresh" class="btn btn-primary" title="refresh form" href="#"><i class='icon-white icon-retweet'></i></a>-->
<a id="ifind" class="btn btn-primary" title="find data" href="#"><i class='icon-white icon-search'></i></a><br />
<p id="msg" style="width: auto;"></p><br />
<div id="reload_table">
 <div style="font-weight: bold;">Number of Records Found: <?php echo mysql_num_rows($mydata); ?> </div>
 <?php if(mysql_num_rows($mydata)<=0){exit();} ?><br /><div style="height:400px; overflow: scroll;">
 <table style="width: auto; cursor: pointer;" cellpadding="0" cellspacing="0" border="0" 
 class="table table-striped table-bordered" id="maintbl" style="font-family: monospace; font-size: large;">
		<thead id="banner" style="cursor: pointer;">
        <tr><th>ID:</th><th>Title:</th><th>Patients First Name:</th><th>Patients Surname:</th>
		<th>Gender:</th><th>Date Captured:</th><th>Status:</th>
                <th style="text-align:center; width: auto;">Action</th>
            </tr></thead>
           <tbody>
<?php		$key_value = "RpD"; //to decrypt-->mcrypt_ecb(MCRYPT_DES, $key_value, $encrypted_text, MCRYPT_DECRYPT)
			while($record = mysql_fetch_array($mydata)) { 
			 $id=$record[0]; ?>
            <tr class='user' id='<?php echo $record[0]; ?>'>
                <td class="p_id"><?php echo $record[0] ?></td>
                <td class="ptitle"><?php echo $record[1] ?></td>
				<td class="pfname"><?php echo $record[2] ?></td>
				<td class="psurname"><?php echo $record[3] ?></td>
				<td class="pgender"><?php echo $record[4] ?></td>
				<td class="pdate" ><?php echo $record[5] ?></td>
				<td class="pstatus"><?php echo $record[6] ?></td>
                <td style='text-align:center;'>
  <!-- <a class="edit btn btn-primary" title='edit <?php echo $record[1].' '.$record[2].' '.$record[3]; ?> record...' 
   href="javascript:nw('<?php  echo "edit.php?pi=".mcrypt_ecb(MCRYPT_DES, $key_value, $record[0], MCRYPT_ENCRYPT).
   "&pn=".mcrypt_ecb(MCRYPT_DES, $key_value, $record[1].' '.$record[2], MCRYPT_ENCRYPT); ?>')" ><i class='icon-white icon-pencil'></i></a>-->
  <a class="edit btn btn-primary" title='edit <?php echo $record[1].' '.$record[2].' '.$record[3]; ?> record...' 
   href="javascript:nw('<?php  echo "edit?gpi=".base64_encode($record[0]).
   "&gpn=".base64_encode($record[1].' '.$record[2].' '.$record[3]); ?>')" ><i class='icon-white icon-pencil'></i></a>
                    &nbsp;|&nbsp;
   <!--<a class="delete_patient btn btn-primary" title='delete <?php echo $record[1].' '.$record[2].' '.$record[3]; ?> record...' href='#'><i class='icon-white icon-trash'></i></a>--> 
                </td></tr>    
<?php 	} ?>  </tbody>
<!--End Loading Data From Database-->
		</table></div></div></div></div><?php  } ?>
	<script type="text/javascript">	
function nw(url){
    var newwin;
	newwin = window.open(url,'','height=300,width=750,top=20,left=70,scrollbars=yes,location=no,toolbar=no');
    if (window.focus) {newwindow.focus();}   
}</script>
</div>
</form>
</body>
</html>