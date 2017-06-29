<?php
include_once ('../lib/library.php');
if ($_SESSION['mtuid']==""){ 
 header ('Location: ../.');
    exit();}	$pagename='pob'; $pagegroup='pi';	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Patient Observation</title>
<link rel="icon" href="../images/lg.png" />
<link href="../css/jquery-ui-1.10.0.custom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/layouts.css" type="text/css" />
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
	$(function() {
		var tabs = $( "#tabs" ).tabs();
		tabs.find( ".ui-tabs-nav" ).sortable({
			axis: "x",
			stop: function() {	tabs.tabs( "refresh" );}});});
	$('#pcrit').change(function(){
		$('#operand').val($('#pcrit option:selected').text());
		if ($('#operand').val()=='Contains'){
			$('#recname').attr('required','');
		} else {$('#recname').attr('required','required');}
		$('#recname').focus();
	});
		$('.edit').click(function(){
			$('#reload_records').slideUp(); $('#observation').slideDown();
	var user = $(this).closest('.user'), id = user.attr('id'), preceipt=$.trim($('.poreceipt',user).text());
		$('#dvLoading').fadeIn(); var pid=$('.p_id',user).text();
		$('#slying').attr('required','required');$('#ssitting').attr('required','required');$('#sstanding').attr('required','required');
		$('#dlying').attr('required','required');$('#dsitting').attr('required','required');$('#dstanding').attr('required','required');
		$('#mlying').attr('required','required');$('#msitting').attr('required','required');$('#mstanding').attr('required','required');
		$('#plying').attr('required','required');$('#psitting').attr('required','required');$('#pstanding').attr('required','required');
		$('#bmi').attr('required','required');$('#height').attr('required','required');$('#weight').attr('required','required');
		$('#waist').attr('required','required');$('#oxygen').attr('required','required');$('#temperature').attr('required','required');
		$('#respiratory').attr('required','required');$('#bglucose').attr('required','required');$('#lmeal').attr('required','required');
	$('#observation input[name="receipt"]').val($('.poreceipt',user).text());
    $('#observation input[name="opatid"]').val($('.p_id',user).text());  
	$('#observation input[name="opatname"]').val($('.ptitle',user).text()+' '+$('.pfname',user).text()+' '+$('.psurname',user).text()); 
	$('#observation input[name="ogender"]').val($('.pgender',user).text());
	$('#observation input[name="osi"]').val($('.psi',user).text());
	$('#img_bg').append('<img align="middle" src="../host/'+pid+'.JPG" style="width: 140px; height: 130px;"/>'); 
	$.get('loadprob.php?receipt=' + $('#receipt').val(), function(data) { 
	$("#mtable").last().append(data);
	});
	$('#dvLoading').fadeOut(); });
	$('#weight').focusout(function(){
	$('#bmi').val(($('#weight').val()/($('#height').val()*$('#height').val())).toFixed(2));
			});
	$('#height').focusout(function(){
	$('#bmi').val(($('#weight').val()/($('#height').val()*$('#height').val())).toFixed(2));
			});
	$('#ifind').click(function(){ 
	$('#reload_records').slideUp('fast');
	$('#vasplus_programming_blog_wrapper').slideDown('slow'); });
	$('#addmore').click(function(){ //validate the fields for multivaluing...
		var probname=$('#probid option:selected').text(),probid=$('#probid').val(),duration=$('#duration').val();
		if ($('#duration').val()==''){$('#duration').focus();}
	$('#mtable').append('<tr><td style="font-weight: bold;">Problem +:</td>'+
	'<td><input type="hidden" readonly="readonly" value="'+probid+'" name="problems[] id="problems" />'+
	'<input type="text" readonly="readonly" value="'+probname+'" name="prob[] id="prob" /> '+
	'<input type="text" readonly="readonly" value="'+duration+'" name="durations[] id="durations" style="width: 110px" /> '+
'<a id="minus_this" href="#" class="minus_this btn btn-primary" title="remove problem"><i class="icon-white icon-minus"></i></a></td></tr>');
		$('#duration').val('');	});
			$('.minus_this').live('click',function() {	$(this).parent().parent().remove();});	//removing a multivalue row
});
  </script>
<?php include_once ('../lib/popclose.php'); ?>
</head>
<body style="background: white;" onload="StartTimers();" onmousemove="ResetTimers();" onmousedown="disablecopy();" oncontextmenu="return false" oncopy="return true" onpaste="return true" oncut="return false" onkeydown="return (event.keyCode != 116)">
<form action="<?php $_SERVER['PHP_SELF']; ?>" id="fname" method="post">
<input type="hidden" value="Contains" name="operand" id="operand" />
<h2 id="banner"><div style="width: auto; float: left;"><img src="../images/mt.png" style="width: 10%; height: 8%;"/>
WELCOME to: <?php echo $_SESSION['app']; ?> </div>	<br /> </h2><hr />
<div id="dvLoading"></div>
<div class="modal-header">
<div id="msg" style="width: auto;"></div>
<div id="tabs"><ul><li><a href="#tabs-1">Patient Observations:-</a></li></ul><br />
<div id="observation" style="display: none; width: auto; overflow: auto;">
<div align="left" style ="float:left;font-weight:bold;">
Patient Booking #: <input type="text" id="receipt" name="receipt" readonly="readonly"/></div> <div class="vpb_lebels_fields" align="right">
<button id="savem" name="savem" type="submit" class="btn btn-primary" title="save record"><i class='icon-white icon-ok'></i></button>
<button id="arefresh" name="arefresh" type="submit" class="btn btn-primary" title="refresh form"><i class='icon-white icon-refresh'></i></button></div><br /><hr style="width: 850px;" />
<div align="left" style="width: 1200px; height:430px; overflow: scroll;">
 <div id="section-navigation" style="float:left; width: 500px;"><table cellspacing="2px">
<tr><td style="font-weight: bold;">Patient ID:</td><td><input type="text" name="opatid" id="opatid" readonly="readonly" class="vasplus_blog_form_opt" /></td></tr>
 <tr><td style="font-weight: bold;">Patient Name:</td><td><input type="text" name="opatname" id="opatname" readonly="readonly" class="vasplus_blog_form_opt" /></td></tr>
 <tr><td style="font-weight: bold;">Attendance Date:</td><td><input type="text" name="opatdate" id="opatdate" readonly="readonly" value="<?php echo date('Y-m-d') ?>" /></td></tr>
 <tr><td style="font-weight: bold;">Gender:</td>
 <td><input type="text" readonly="readonly" id="ogender" name="ogender" /></td></tr>
 <tr><td style="font-weight: bold;">Clinician (SI):</td>
 <td><input type="text" readonly="readonly" id="osi" name="osi" class="vasplus_blog_form_opt" /></td></tr>
</table><hr style="width: 850px;" />
<!--observation column---------------------------------->
<div id="footer" style="width: 1100px;">
<div align="left" style="width: auto; float: left;"><fieldset><legend>Presenting Complain(s):-</legend>
<table style="width: 600px" id="mtable" class="table table-striped table-bordered">
 <tr><td style="font-weight: bold;">Problem:</td><td><select name="probid" id="probid">';
<?php $mydata=mysql_query("select prob_id,problem from problem_type where status like 'active' order by problem") or die(mysql_error());
	while ($rows=mysql_fetch_array($mydata)){ 
 echo '<option value="'.$rows[0].'">'.$rows[1].'</option>'; } ?>
 </select> <input type="text" name="duration" id="duration" maxlength="20" style="width: 110px" placeholder="Problem Duration" /> <a id="addmore" href="#" class="btn btn-primary" title="add more problems"><i class="icon-white icon-plus"></i></a></td></tr></table></fieldset>
 </div>
<div id="footer" align="left" style="width: auto;"><fieldset><legend>Observations:-</legend>
<div align="left" style="width: auto; float: left;">
<table class="table table-striped table-bordered" style="width: auto; border:1px solid #CCC;" cellpadding="2px" cellspacing="5px">
<thead><td style="font-weight: bold;">Parameter:</td><td style="font-weight: bold;">Findings:</td></thead>
<tbody><tr><td style="font-weight: bold; font-style: italic;">Blood Pressure*:</td>
<td><table style="width: auto; border:1px solid #CCC;">
<tr style="font-weight: bold; font-style: italic;"><td></td><td>Lying</td><td>Sitting</td><td>Standing</td></tr>
<tr><td style="font-weight: bold; font-style: italic;">Systolic*:</td>
<td style="text-align: center;"><input type="text" name="slying" id="slying" value="0" style="width: 35px" /></td>
<td style="text-align: center;"><input type="text" name="ssitting" id="ssitting" value="0" style="width: 35px" /></td>
<td style="text-align: center;"><input type="text" name="sstanding" id="sstanding" value="0" style="width: 35px" /></td></tr>
<tr><td style="font-weight: bold; font-style: italic;">Diastolic*:</td>
<td style="text-align: center;"><input type="text" name="dlying" id="dlying" value="0" style="width: 35px" /></td>
<td style="text-align: center;"><input type="text" name="dsitting" id="dsitting" value="0" style="width: 35px" /></td>
<td style="text-align: center;"><input type="text" name="dstanding" id="dstanding" value="0" style="width: 35px" /></td></tr>
<tr><td style="font-weight: bold; font-style: italic;">MAP*:</td>
<td style="text-align: center;"><input type="text" name="mlying" id="mlying" value="0" style="width: 35px" /></td>
<td style="text-align: center;"><input type="text" name="msitting" id="msitting" value="0" style="width: 35px" /></td>
<td style="text-align: center;"><input type="text" name="mstanding" id="mstanding" value="0" style="width: 35px" /></td></tr>
</table></td></tr>
<tr><td style="font-weight: bold; font-style: italic;">Pulse*:</td>
<td><table style="width: auto; border:1px solid #CCC;">
<tr style="font-weight: bold; font-style: italic;">
<td></td><td>Lying</td><td>Sitting</td><td>Standing</td></tr>
<tr style="text-align: right;"><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td style="text-align: center;"><input type="text" name="plying" id="plying" value="0" style="width: 35px" /></td>
<td style="text-align: center;"><input type="text" name="psitting" id="psitting" value="0" style="width: 35px" /></td>
<td style="text-align: center;"><input type="text" name="pstanding" id="pstanding" value="0" style="width: 35px" /></td></tr>
</table></td></tr>
</tbody>
</table></div>
<div align="left" style="width: auto; float: left;">	 
 <table class="table table-striped table-bordered" align="left" style="width: 600px; border:1px solid #CCC;">
 <tr><td colspan="2" style="font-weight: bold; font-style: italic;">Oxygen Saturation*:</td>
 <td colspan="2"><input type="text" name="oxygen" id="oxygen" value="0" placeholder="" style="width: 35px" />%</td>
 <td colspan="2" style="font-weight: bold; font-style: italic; text-align: right;">Respiratory Rate*:</td>
 <td colspan="2"><input type="text" name="respiratory" value="0" id="respiratory" style="width: 35px" /></td></tr>
 <tr><td colspan="2" style="font-weight: bold; font-style: italic;">Temperature*:</td>
 <td colspan="2"><input type="text" name="temperature" id="temperature" placeholder="Oc" value="0" style="width: 35px" /></td>
 <td colspan="2" style="font-weight: bold; font-style: italic;">Level of Consciousness*:</td>
 <td colspan="2" style="font-weight: bold; font-style: italic;"><input type="checkbox" name="alert" id="alert" value="Alert"/>Alert<br />
 <input type="checkbox" name="voice" id="voice" value="Responsive to voice"/>Responsive to voice<br /> 
 <input type="checkbox" name="pain" id="pain" value="Responsive to pain"/>Responsive to pain<br />
 <input type="checkbox" name="unres" id="unres" value="Unresponsive"/>Unresponsive</td></tr>
 <tr><td style="font-weight: bold; font-style: italic;">Weight*:</td>
	<td><input type="text" name="weight" id="weight" value="0" style="width: 35px" /> kg</td>
	<td style="font-weight: bold; font-style: italic;">Height*:</td>
	<td><input type="text" name="height" id="height" value="0" style="width: 35px" /> meters</td>
	<td style="font-weight: bold; font-style: italic;">BMI*:</td>
	<td><input type="text" name="bmi" id="bmi" value="0" style="width: 35px" /></td>
	<td style="font-weight: bold; font-style: italic;">Waist Circumference*:</td>
	<td><input type="text" name="waist" id="waist" value="0" style="width: 35px" /></td></tr>
<!--	<table class="table table-striped table-bordered" align="left" style="width: auto; border:1px solid #CCC;">-->
<tr><td colspan="2" style="font-weight: bold; font-style: italic;">Capillary Blood Glucose*:</td>
	<td colspan="2"><input type="text" name="bglucose" id="bglucose" value="0" style="width: 35px" />mmol/l</td>
	<td colspan="2" style="font-weight: bold; font-style: italic;">Hours From Last Meal*:</td>
	<td colspan="2"><input type="text" name="lmeal" id="lmeal" value="0" style="width: 35px" /></td></tr></table>
</div>
</fieldset></div>
</div>
</div>
<div id="img_bg" class="content" align="left" style="float:left; width: auto; height: 160px;"></div>

</div>

</div>
<br clear="all" />
<!-----------------------------------end of patient observation---------------------------------------->
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
<div id="reload_records">
<?php  if (isset($_POST['recname']) && !empty($_POST['recname'])){ //load data when user posts problem by clicking find button
		if ($_POST['operand']=='Contains'){ 
$mydata = mysql_query("SELECT d.attend_id,a.p_id,a.title,a.fname,a.surname,a.gender,
 (select b.uname from s_users b where b.logname=d.si) as clinician,(select b.uname from s_users b where b.logname=d.inputter) as inputter
from patients a,pat_attendance d where concat(a.fname,' ',a.surname) 
 ".$_POST['pcrit']." '%".$_POST['recname']."%' and a.p_id=d.p_id and d.si != 'nsi' order by d.doa desc,d.t_in desc") or die(mysql_error());	
		}elseif ($_POST['operand']=='Starts With'){ 
$mydata = mysql_query("SELECT d.attend_id,a.p_id,a.title,a.fname,a.surname,a.gender,
 (select b.uname from s_users b where b.logname=d.si) as clinician,(select b.uname from s_users b where b.logname=d.inputter) as inputter 
from patients a,pat_attendance d where concat(a.fname,' ',a.surname) 
 ".$_POST['pcrit']." '".$_POST['recname']."%' and a.p_id=d.p_id and d.si != 'nsi'
  order by d.doa desc,d.t_in desc") or die(mysql_error());	
		}else {
$mydata = mysql_query("SELECT d.attend_id,a.p_id,a.title,a.fname,a.surname,a.gender,
 (select b.uname from s_users b where b.logname=d.si) as clinician,(select b.uname from s_users b where b.logname=d.inputter) as inputter
  from patients a,pat_attendance d where concat(a.fname,' ',a.surname) 
 ".$_POST['pcrit']." '".$_POST['recname']."' and a.p_id=d.p_id and d.si != 'nsi'
  order by d.doa desc,d.t_in desc") or die(mysql_error()); }
 ?>
 <div class="info" id="pop">Records for Patients that <?php  echo $_POST['operand'].': '. $_POST['recname']; ?></div> <br />
<?php }else { //load data when user click refresh to load all records
	dataRecords:
$mydata = mysql_query("SELECT d.attend_id,a.p_id,a.title,a.fname,a.surname,a.gender,
 (select b.uname from s_users b where b.logname=d.si) as clinician,(select b.uname from s_users b where b.logname=d.inputter) as inputter
 from patients a,pat_attendance d where d.si != 'nsi' and a.p_id=d.p_id
  order by d.doa desc,d.t_in desc") or die(mysql_error());}?> 
<button id="refresh" name="refresh" type="submit" class="btn btn-primary" title="refresh form"><i class='icon-white icon-refresh'></i></button>
<a id="ifind" class="btn btn-primary" title="find data" href="#"><i class='icon-white icon-search'></i></a><br />
<p id="msg" style="width: auto;"></p>
<div id="reload_table">
 <div style="font-weight: bold;">Number of Records Found: <?php echo mysql_num_rows($mydata); ?> </div>
 <?php if(mysql_num_rows($mydata)<=0){exit();} ?><br /><div style="height:400px; overflow: scroll;">
 <table style="width: auto; cursor: pointer;" cellpadding="0" cellspacing="0" border="0" 
 class="table table-striped table-bordered" id="maintbl" style="font-family: monospace; font-size: large;">
		<thead id="banner" style="cursor: pointer;">
        <tr><th>Receipt #:</th><th>ID:</th><th>Title:</th><th>Patients First Name:</th><th>Patients Surname:</th>
		<th>Gender:</th><th>Clinician (SI)</th><th>Inputter:</th>
                <th style="text-align:center; width: auto;">Action</th>
            </tr></thead><tbody><?php
			while($record = mysql_fetch_array($mydata)) { 
			 $id=$record[0]; ?>
            <tr class='user' id='<?php echo $record[0]; ?>'>
				<td class="poreceipt"><?php echo $record[0] ?></td>
                <td class="p_id"><?php echo $record[1] ?></td>
                <td class="ptitle"><?php echo $record[2] ?></td>
				<td class="pfname"><?php echo $record[3] ?></td>
				<td class="psurname"><?php echo $record[4] ?></td>
				<td class="pgender"><?php echo $record[5] ?></td>
				<td class="psi" ><?php echo $record[6] ?></td>
				<td class="pinputter"><?php echo $record[7] ?></td>
                <td style='text-align:center;'>
  <a class="edit btn btn-primary" title='edit <?php echo $record[1].' '.$record[2].' '.$record[3]; ?> record...' 
   href="#" ><i class='icon-white icon-pencil'></i></a></td></tr>    
<?php 	} ?>  </tbody>
<!--End Loading Data From Database-->
		</table></div></div></div><?php  } ?> </div>
</div>
</form>
</body>
</html>