<?php  
include_once ('../lib/library.php');
if ($_SESSION['mtuid']==""){ 
 header ('Location: ../.');
    exit();}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
<title>New Patient Data</title>            
<link rel="icon" href="../images/flag.png" />
<link href="../css/jquery-ui-1.10.0.custom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/jquery.datepick.css" type="text/css" />
<link rel="stylesheet" href="../css/bootstrap.css" type="text/css" /> 
<link rel="stylesheet" href="../css/jquery.qtip.min.css" type="text/css"/>
<link rel="stylesheet" href="../lib/screen.css" type="text/css" />
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
<script type="text/javascript" src="js/myjquery.js"></script>
<script type="text/javascript" src="../js/jquery.plugin.js"></script>
<script type="text/javascript" src="../js/jquery.datepick.js"></script>
<script src="../js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.qtip.min.js"></script>
<style>
#dvLoading{background: url(../images/loading.gif) no-repeat center center;
   height: 50px; width: 100px; position: fixed; z-index: 1000; left: 50%; top: 30%; margin: -25px 0 0 -25px;
}</style>
<script>
$(document).ready(function(){
	$('#dvLoading').fadeOut(1000);
	var today = $.datepick.today();
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
//$('#pdob').datepick({yearRange: <?php echo date('Y') ?>+':1900'});
//$('#pdob').datepick({maxDate: new Date(<?php echo date('Y') ?>, <?php echo date('m') ?>, <?php echo date('d') ?>)}); 
//$('#pdob').datepick({pickerClass: 'noPrevNext', maxDate: +0, minDate: '01/01/1900', showTrigger: '#calImg'});
$('#pdob').datepick({pickerClass: 'datepick-jumps', 
    renderer: $.extend({}, $.datepick.defaultRenderer, 
        {picker: $.datepick.defaultRenderer.picker. 
            replace(/\{link:prev\}/, '{link:prevJump}{link:prev}'). 
            replace(/\{link:next\}/, '{link:nextJump}{link:next}')}), pickerClass: 'noPrevNext', maxDate: +0, minDate: '01/01/1900',
    yearRange: <?php echo date('Y') ?>+':1900',showTrigger: '#calImg'});		
	
});
</script>
</head>
<?php include_once ('../lib/popclose.php'); ?>
<body style="background: white;" onload="StartTimers();" onmousemove="ResetTimers();" onmousedown="disablecopy();" oncontextmenu="return false" oncopy="return false" onpaste="return false" oncut="return false">
<form name="" action="." method="post" enctype="multipart/form-data" >
<h2 id="banner"><div style="width: auto; float: left;"><img src="../images/mt.png" height="30px" width="50px"/>
WELCOME to: <?php echo $_SESSION['app']; ?> </div>
	<div style="float: right; width: 15%;"><p>
	</p></div>														
 <br /> 
</h2>
<hr />
<div id="dvLoading"></div>
<div class="modal-header">
<div class="vpb_lebels" align="left">
<button id="add" name="addrec" type="submit" class="btn btn-primary" title="add new data"><i class='icon-white icon-plus'></i></button>
<!--<a id="add" href="#" class="btn btn-primary" title="add new data"><i class='icon-white icon-plus'></i></a>-->
 <button id="save" name="saverec" type="submit" class="btn btn-primary" title="save data"><i class='icon-white icon-ok'></i></button></div>
<br />
<div id="tabs">
	<ul><li><a href="#tabs-1">Clinical Notes</a></li>
	</ul><br />
<?php	$id=''; if (isset($_POST['saverec'])) {
	if (empty($_POST['patid'])){
	echo '<div style="width: auto;" id="msg" class="info">Patient Id was required.</div>'; $id=''; goto InputMode;	}
  	$allowedExts = array("jpeg", "jpg", "JPG"); $temp = explode(".", $_FILES["file"]["name"]);$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/JPG"))
&& ($_FILES["file"]["size"] <= 2097152) && in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    echo '<div style="width: auto;" id="msg" class="info">Error: ' . $_FILES["file"]["error"] . '</div>';}
 else {$file=$_POST['patid'].'.JPG';
  	move_uploaded_file($_FILES['file']['tmp_name'],"../host/" .$file);
	$mydata=mysql_query("insert into patients values ('".$_POST['patid']."','".$_POST['ptitle']."','".ucwords($_POST['pfname'])."',
'".ucwords($_POST['psurname'])."','".$_POST['pgender']."','".$_POST['pdob']."','".$_POST['ptel']."','".$_POST['pemail']."',
'".$_POST['paddress']."','".$_POST['pmarital']."','".$_POST['psponsor']."','".date('Y-m-d')."','".$_SESSION['logname']."')")
	 or die(mysql_error());
	echo '<div style="width: auto;" id="msg" class="info">'.$_POST['pfname'].' '.$_POST['psurname'].' record saved successfully...</div>';
 				$id='';	goto InputMode; }
} else {  echo '<div style="width: auto;" id="msg" class="info">Invalid file selected for patient.</div>'; $id=''; goto InputMode;}
 } 
  if (isset($_POST['addrec'])){
 	 $pid='MtZH'.date('ym');
	$genid=mysql_query("select * from pat_gen where pat_id='".$pid."'") or die(mysql_error()); 
		if (mysql_num_rows($genid)<=0){ //means the month has no id generated
		$genid=mysql_query("insert into pat_gen values ('".$pid."','0')") or die(mysql_error());} //now reselect the patient generate id
	$genid=mysql_query("select * from pat_gen where pat_id='".$pid."'") or die(mysql_error());
		while ($newid=mysql_fetch_array($genid)){ $id=$newid[1]+1;}
		if ($id<10){$id=$pid.'0'.$id;} else{$id=$pid.$id;} 
		$genid=mysql_query("update pat_gen set nums=nums+1 where pat_id='".$pid."'") or die(mysql_error()); 
				InputMode:	?>	
 	<script>$('#inputData').slideDown('fast');</script>
	
	<div align="left" style="width: 800px;">
	<fieldset><legend>Official Data:-</legend>
	<div class="vpb_lebels" align="left" style ="float:left; width: 550px;"> <table cellspacing="2px" cellpadding="2px"><tr><td style="font-weight: bold;">
		Patient ID <font color="red">*</font>: </td>
		<td><input type="text" id="patid" name="patid" required="required" readonly="readonly" value="<?php echo $id ?>" /></td></tr>
	<tr><td style="font-weight: bold;">Upload Patient Photo <font color="red">*</font>:</td>
	<td><input type="file" name="file" id="file" required="required"/></td></tr>	
	<tr><td style="font-weight: bold;">Date Capturing:</td>
	<td><input type="text" value="<?php echo date('d-M-Y') ?>" name="pdate" id="pdate" readonly="readonly"/></td></tr></table></div>
	<div class="vpb_lebels_fields" align="left"> <img src="../host/male.png" width="150px" height="140px"/> </div></fieldset> </div>
	
	<div class="vpb_lebels" align="left" style="width: 800px;"><fieldset><legend>Personal Data:-</legend></fieldset>
	<table style="width: auto;" >
	<tr><td style="font-weight: bold;">Title <font color="red">*</font>:</td>
	<td><select id="ptitle" name="ptitle"><option value="Mr">Mr</option><option value="Alhaji">Alhaji</option>
	<option value="Mrs">Mrs</option><option value="Ms">Ms</option><option value="Dr">Dr</option>
	<option value="Prof">Prof</option><option value="Hon">Hon</option><option value="Rev">Rev</option>
	<option value="Nana">Nana</option><option value="Pastor">Pastor</option></select></td>
	<td style="font-weight: bold;">Marital Status <font color="red">*</font>:</td>
	<td><select id="pmarital" name="pmarital"><option value="Single">Single</option><option value="Married">Married</option>
	<option value="Divorced">Divorced</option><option value="Widow">Widow</option><option value="Widower">Widower</option></select></td></tr>
<tr><td style="font-weight: bold;">First & Middle Name(s) <font color="red">*</font>:</td>
 <td><input type="text" maxlength="50" name="pfname" id="pfname" placeholder="First & Middle Names" required="required" /></td>
<td style="font-weight: bold;">Surname <font color="red">*</font>:</td>
<td><input type="text" maxlength="50" name="psurname" id="psurname" placeholder="Surname" required="required" /></td></tr>
<tr><td style="font-weight: bold;">Gender <font color="red">*</font>:</td>
<td><select id="pgender" name="pgender"><option value="Male">Male</option><option value="Female">Female</option></select></td>
	<td style="font-weight: bold;">Date of Birth <font color="red">*</font>:</td>
	<td><input type="text" id="pdob" name="pdob" maxlength="15" required="required" /></td></tr></table>
	
	<div style="width: 800px;">
	<fieldset><legend>Personal Contacts:-</legend><table style="width: auto;">
<tr><td style="font-weight: bold;">Patient Telephone :</td>
<td><input type="tel" name="ptel" id="ptel" placeholder="Telephone" maxlength="30" /></td>
	<td style="font-weight: bold;">Patient Email :</td>
	<td><input type="text" maxlength="30" id="pemail" name="pemail" /></td></tr>
<tr><td style="font-weight: bold;">Residencial Address <font color="red">*</font>:</td>
<td><input type="text" maxlength="50" name="paddress" id="paddress" placeholder="Address/Residence" required="required" /></td>
	<td style="font-weight: bold;">Patient Sponsor <font color="red">*</font>:</td>
	<td><select id="psponsor" name="psponsor">
	<?php $mydata=mysql_query("select * from pat_spon where status like 'active' order by sp_name") or die(mysql_error());
	while ($rows=mysql_fetch_array($mydata)){ ?>
		<option value="<?php echo $rows[0] ?>"><?php echo $rows[1] ?></option> <?php } ?>
	</select></td></tr>

	</table></fieldset></div>
</div>
<?php } 	 ?></div></div>
</form>

</body>