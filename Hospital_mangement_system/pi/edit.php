<?php
 include_once ('../lib/library.php');
if ($_SESSION['mtuid']==""){ 
 header ('Location: ../.');
    exit();} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo base64_decode($_GET['gpn']); ?>Edit</title>
<link rel="icon" href="../images/lg.png" />
<link href="../css/jquery-ui-1.10.0.custom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/jquery.datepick.css" type="text/css" />
<link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.css" type="text/css"/> 
<link rel="stylesheet" href="../css/jquery.qtip.min.css" type="text/css"/>
<link rel="stylesheet" href="../lib/screen.css" type="text/css" />
<link rel="stylesheet" href="../css/style.css" type="text/css" />
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/bootstrap.js" type="text/javascript"></script>
<script src="../js/jquery.dataTables.js"  type="text/javascript" ></script>
<script src="../js/DT_bootstrap.js" type="text/javascript" ></script>
<script src="js/myjquery.js"  type="text/javascript" ></script>
<script src="../js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="../js/jquery.qtip.min.js" type="text/javascript" ></script> 
<script type="text/javascript" src="../js/jquery.plugin.js"></script>
<script type="text/javascript" src="../js/jquery.datepick.js"></script>
<style>
#dvLoading{background: url(../images/loading.gif) no-repeat center center;
   height: 50px; width: 100px; position: fixed; z-index: 1000; left: 50%; top: 30%; margin: -25px 0 0 -25px;}</style>
<script type="text/javascript">
$(document).ready(function() {   
	$('#dvLoading').fadeOut('slow');

	$(function() {
		var tabs = $( "#tabs" ).tabs();
		tabs.find( ".ui-tabs-nav" ).sortable({
			axis: "x",
			stop: function() {
				tabs.tabs( "refresh" );
			}
		});
	});

$(function() {$('#pdob').datepick();}); 
$('#pdob').datepick({pickerClass: 'datepick-jumps', 
    renderer: $.extend({}, $.datepick.defaultRenderer, 
        {picker: $.datepick.defaultRenderer.picker. 
            replace(/\{link:prev\}/, '{link:prevJump}{link:prev}'). 
            replace(/\{link:next\}/, '{link:nextJump}{link:next}')}), pickerClass: 'noPrevNext', maxDate: +0, minDate: '01/01/1900',
    yearRange: <?php echo date('Y') ?>+':1900',showTrigger: '#calImg'});
 });
</script>
<?php include_once ('../lib/popclose.php'); ?>
</head>
<body style="background: white;" onload="StartTimers();" onmousemove="ResetTimers();" onmousedown="disablecopy();" oncontextmenu="return false" oncopy="return false" onpaste="return false" oncut="return false">
<form action="<?php $_SERVER['PHP_SELF'].'?pi='.base64_decode($_GET['gpi']); ?>" method="post" name="myform" id="myform">
<input type="hidden" name="ctm" id="ctm" value="-1"/><input type="hidden" name="mname" id="mname" value=""/>
<h2 id="banner"><div style="width: auto; float: left;"><img src="../images/mt.png" style="width: 10%; height: 8%;"/>
WELCOME to: <?php echo $_SESSION['app']; ?> </div>
	<div style="float: right; width: 15%;"><p>
	</p></div>	<br /> </h2><hr />
	<div id="dvLoading"></div>
<div class="modal-header">
<!--//////////////////////////////////// Patient Edit ///////////////////////////////////////-->
<button id="savem" name="savem" class="btn btn-primary" title="save record"><i class="icon-white icon-ok"></i></button>
<button id="refresh" class="btn btn-primary" title="refresh form"><i class='icon-white icon-refresh'></i></button>
<br /><br />
<?php //saving patient record details..
	IF (isset($_POST['savem'])){
		if (!empty($_POST['file'])){ //save image uploaded
			$allowedExts = array("jpeg", "jpg", "JPG"); $temp = explode(".", $_FILES["file"]["name"]);$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/JPG"))
&& ($_FILES["file"]["size"] <= 2097152) && in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    echo '<div style="width: auto;" id="msg" class="info">Error: ' . $_FILES["file"]["error"] . '</div>';}
 else {$file=$_POST['patid'].'.JPG'; move_uploaded_file($_FILES['file']['tmp_name'],"../host/" .$file);	}
	}}
		$mydata=mysql_query("update patients set title='".$_POST['ptitle']."',fname='".ucwords($_POST['pfname'])."',
	surname='".ucwords($_POST['psurname'])."',gender='".$_POST['pgender']."',status='active',
	inputter='".$_SESSION['logname']."' where p_id='".$_POST['patid']."'")
	 or die(mysql_error());
	 $mydata=mysql_query("update patient_details set dbirth='".$_POST['pdob']."',ptel='".$_POST['ptel']."',
	 email='".$_POST['pemail']."',address='".ucwords($_POST['paddress'])."',m_status='".$_POST['pmarital']."',
	 sp_id='".$_POST['psponsor']."',inputter='".$_SESSION['logname']."' where p_id='".$_POST['patid']."'")
	 or die(mysql_error()); ?> <script>$('#tabs').slideUp('fast');</script>
	<?php	echo '<div style="width: auto;" id="msg" class="info">'
	.$_POST['pfname'].' '.$_POST['psurname'].' record updated successfully...</div>'; exit();	
				}
 ?>
<div id="tabs">
	<ul><li><a href="#tabs-1">Clinical Notes</a></li></ul><br />
 <?php $mydata=mysql_query("select a.*,b.* from patients a,patient_details b where a.p_id='".base64_decode($_GET['gpi'])."' 
 and a.p_id = b.p_id") or die(mysql_error()); 
 //$mydata=mysql_query("select a.* from patients a where a.p_id='".base64_decode($_GET['gpi'])."' ") or die(mysql_error());
 	if (mysql_num_rows($mydata)<=0){echo '<div id="msg" class="info">No patient record found for: '.base64_decode($_GET['gpn']).'</div>';exit();}
  				while ($header=mysql_fetch_array($mydata)){  ?>   
  <div id="inputdata" style="height:440px; overflow: scroll;">
	<div align="left" style="width: 800px;" >
	<fieldset><legend>Official Data:-</legend>
	<div class="vpb_lebels" align="left" style ="float:left; width: 550px;"> <table cellspacing="2px" cellpadding="2px">
	<tr><td style="font-weight: bold;">
		Patient ID <font color="red">*</font>: </td>
		<td><input type="text" id="patid" name="patid" required="required" readonly="readonly" value="<?php echo $header[0]; ?>" /></td></tr>
	<tr><td style="font-weight: bold;">Upload Patient Photo :</td>
	<td><input type="file" name="file" id="file" /></td></tr>	
	<tr><td style="font-weight: bold;">Date Captured:</td>
	<td><input type="text" value="<?php echo $header[5] ?>" readonly="readonly" name="pdate" id="pdate" readonly="readonly"/>
	</td></tr></table></div>
	<div id="vasplus_programming_blog_wrapper" class="vpb_lebels_fields" align="left" style="width: 160px; height: 150px;" > 
	<img src="../host/<?php echo $header[0].'.JPG' ?>" width="150px" height="140px"/> </div></fieldset></div>
	
	<div align="left" style="width: 800px;"><fieldset><legend>Patient Data:-</legend>
	<table style="width: auto;" >
	<tr><td style="font-weight: bold;">Title <font color="red">*</font>:</td>
	<td><select id="ptitle" name="ptitle"><option value="<?php echo $header[1] ?>"><?php echo $header[1] ?></option>
	<option value="Mr">Mr</option><option value="Alhaji">Alhaji</option>
	<option value="Mrs">Mrs</option><option value="Ms">Ms</option><option value="Dr">Dr</option>
	<option value="Prof">Prof</option><option value="Hon">Hon</option><option value="Rev">Rev</option>
	<option value="Nana">Nana</option><option value="Pastor">Pastor</option></select></td>
	<td style="font-weight: bold;">Marital Status <font color="red">*</font>:</td>
	<td><select id="pmarital" name="pmarital">
 <option value="<?php echo $header[13] ?>"><?php echo $header[13] ?></option><option value="Single">Single</option>
 <option value="Married">Married</option>
	<option value="Divorced">Divorced</option><option value="Widow">Widow</option><option value="Widower">Widower</option></select></td</tr>
<tr><td style="font-weight: bold;">First & Middle Name(s) <font color="red">*</font>:</td>
 <td><input type="text" maxlength="50" name="pfname" id="pfname" placeholder="First & Middle Names" required="required" value="<?php echo $header[2] ?>" /></td>
<td style="font-weight: bold;">Surname <font color="red">*</font>:</td>
<td><input type="text" maxlength="50" name="psurname" id="psurname" placeholder="Surname" required="required" value="<?php echo $header[3] ?>" /></td></tr>
<tr><td style="font-weight: bold;">Gender <font color="red">*</font>:</td>
<td><select id="pgender" name="pgender"><option value="<?php echo $header[4] ?>"><?php echo $header[4] ?></option>
<option value="Male">Male</option><option value="Female">Female</option></select></td>
<td style="font-weight: bold;">Date of Birth <font color="red">*</font>:</td>
<td><input type="text" id="pdob" name="pdob" maxlength="15" value="<?php echo $header[9] ?>" /></td></tr></table></fieldset>

	<div align="left" style="width: 800px;">
	<fieldset><legend>Patient Contacts:-</legend><table style="width: auto;">
<tr><td style="font-weight: bold;">Patient Telephone :</td>
<td><input type="tel" name="ptel" id="ptel" placeholder="Telephone" maxlength="30" value="<?php echo $header[10] ?>" /></td>
	<td style="font-weight: bold;">Patient Email :</td>
	<td><input type="text" maxlength="30" id="pemail" name="pemail" value="<?php echo $header[11] ?>" placeholder="Email Address" /></td></tr>
<tr><td style="font-weight: bold;">Residencial Address <font color="red">*</font>:</td>
<td><input type="text" maxlength="50" name="paddress" id="paddress" placeholder="Address/Residence" value="<?php echo $header[12] ?>" /></td>
	<td style="font-weight: bold;">Patient Sponsor <font color="red">*</font>:</td>
	<td><select id="psponsor" name="psponsor">
	<?php $mydata=mysql_query("select * from pat_spon where status like 'active' order by sp_name") or die(mysql_error());
	while ($rows=mysql_fetch_array($mydata)){ ?>
	<option value="<?php echo $rows[0] ?>" <?php if ($header[14]==$rows[0]){ ?> selected='selected' <?php } ?>><?php echo $rows[1] ?></option> 
	<?php } ?></select></td></tr></table></fieldset></div></div>
</div> <br /> <?php } ?> 
<script type="text/javascript">	
function nw(url){var newwin;
	newwin = window.open(url,'','height=500,width=850,top=20,left=50,scrollbars=yes,location=no,toolbar=no');
    if (window.focus) {newwindow.focus();}}</script>
	</div></div></form>
</body>
</html>