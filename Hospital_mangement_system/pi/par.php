<?php
include_once ('../lib/library.php');
if ($_SESSION['mtuid']==""){ 
 header ('Location: ../.');
    exit();} $pagename='par'; $pagegroup='pi';	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Patient Attendance Record</title>
<link rel="icon" href="../images/lg.png" /><link rel="stylesheet" href="../css/jquery.datepick.css" type="text/css" />
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
<script type="text/javascript" src="../js/jquery.plugin.js"></script>
<script type="text/javascript" src="../js/jquery.datepick.js"></script>
<style>
#dvLoading{background: url(../images/loading.gif) no-repeat center center;
   height: 50px; width: 100px; position: fixed; z-index: 1000; left: 50%; top: 30%; margin: -25px 0 0 -25px;}</style>
  <script type="text/javascript">
$(document).ready(function(){ 
$('#dvLoading').fadeOut(1000);
	$.datepick.setDefaults({dateFormat: 'yyyy-mm-dd'});
	
	$(function() {var tabs = $("#tabs").tabs();
		tabs.find( ".ui-tabs-nav" ).sortable({
			axis: "x",
			stop: function() {tabs.tabs( "refresh" );}});	});
	
	$('#pcrit').change(function(){
		$('#operand').val($('#pcrit option:selected').text());
		if ($('#operand').val()=='Booked Patients'){
		$(function() {$('#recname').datepick();}); 
	$('#recname').datepick({pickerClass: 'datepick-jumps', 
    renderer: $.extend({}, $.datepick.defaultRenderer, 
        {picker: $.datepick.defaultRenderer.picker. 
            replace(/\{link:prev\}/, '{link:prevJump}{link:prev}'). 
            replace(/\{link:next\}/, '{link:nextJump}{link:next}')}), pickerClass: 'noPrevNext', maxDate: +0, minDate: '01/01/1900',
    yearRange: <?php echo date('Y') ?>+':1900',showTrigger: '#calImg'});
		}	else if ($('#operand').val()=='Contains'){
			$('#recname').attr('required',''); $('#recname').datepick('destroy'); $('#recname').focus();
		} else {$('#recname').attr('required','required'); $('#recname').datepick('destroy'); $('#recname').focus();}
	});

		$('.td_1').hide();
	$('.register').click(function(){
		$('#reload_records').slideUp('fast');
		$('#attendance').slideDown();
    var user = $(this).closest('.user');  var id = user.attr('id'); 
    $('#attendance input[name="apatid"]').val($('.p_id',user).text());  
	$('#attendance input[name="apatname"]').val($('.pfname',user).text()+' '+$('.psurname',user).text()); 
	$('#attendance input[name="apatspon"]').val($('.psponsor',user).text());
	$('#image_bg').append('<img align="middle" src="../host/'+id+'.JPG" style="width: 150px; height: 140px;"/>');	});

	$('.assign').click(function(){
		//$('#savem').attr('name','bsavem');
		$('#reload_records').slideUp('fast');var user = $(this).closest('.user');  var id = user.attr('id');
		$('#booking').slideDown(); var preceipt=$.trim($('.regid',user).text());
		$('#dvLoading').fadeIn('slow'); var pid=$('.p_id',user).text();
    $('#booking input[name="bpatid"]').val($('.p_id',user).text()); 
	$('#booking input[name="receipt"]').val($.trim($('.regid',user).text())); 
	$('#booking input[name="bpatname"]').val($('.title',user).text()+' '+$('.pfname',user).text()+' '+$('.psurname',user).text()); 
	$('#booking input[name="bpatspon"]').val($('.psponsor',user).text());
	$('#img_bg').append('<img align="middle" src="../host/'+pid+'.JPG" style="width: 140px; height: 130px;"/>'); 
	$('#dvLoading').fadeOut('fast'); });

	$('#addmore').click(function(){ //validate the fields for multivaluing...
		var probname=$('#probid option:selected').text(),probid=$('#probid').val(),duration=$('#duration').val();
		if ($('#duration').val()==''){$('#duration').focus();}
	$('#mtable').append('<tr><td style="font-weight: bold;">Problem +:</td>'+
	'<td><input type="hidden" readonly="readonly" value="'+probid+'" name="problems[] id="problems" />'+
	'<input type="text" readonly="readonly" value="'+probname+'" name="prob[] id="prob" /> '+
	'<input type="text" readonly="readonly" value="'+duration+'" name="durations[] id="durations" style="width: 110px" /> '+
'<a id="minus_this" href="#" class="minus_this btn btn-primary" title="remove problem"><i class="icon-white icon-minus"></i></a></td></tr>');
		$('#duration').val('');		$('#probs').val($('#mtable').find('tr').index()-6);	});
	$('#ifind').click(function(){ $('#reload_records').slideUp('fast');$('#vasplus_programming_blog_wrapper').slideDown('slow');	});
	$('#recname').click(function(){$('#msg').remove();});
	$('.minus_this').live('click',function() {
		$(this).parent().parent().remove(); $('#probs').val($('#mtable').find('tr').index()-6);
			});	//removing a multivalue row
	
	
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

<!--<div id="maincontent" style="display: none;">-->
<div id="tabs"><ul><li><a href="#tabs-1">Patient Attendance Register:</a></li></ul><br />
<div id="attendance" style="display: none; text-align: center; width: auto;">
<div align="left" style ="float:left;font-weight:bold;">
Patient Data: </div> <div class="vpb_lebels_fields" align="right">
<button id="savem" name="savem" type="submit" class="btn btn-primary" title="save record"><i class='icon-white icon-ok'></i></button>
<button id="arefresh" name="arefresh" type="submit" class="btn btn-primary" title="refresh form"><i class='icon-white icon-refresh'></i></button></div>
<br /><hr /><div align="left" style="width: 800px; height: 350px; overflow: scroll;"><div align="left" style="float:left; width: 400px;"><table cellspacing="2px">
<tr><td style="font-weight: bold;">Patient ID:</td><td><input type="text" name="apatid" id="apatid" readonly="readonly" class="vasplus_blog_form_opt" /></td></tr>
 <tr><td style="font-weight: bold;">Patient Name:</td><td><input type="text" name="apatname" id="apatname" readonly="readonly" class="vasplus_blog_form_opt" /></td></tr>
 <tr><td style="font-weight: bold;">Attendance Date:</td><td><input type="text" name="apatdate" id="apatdate" readonly="readonly" value="<?php echo date('Y-m-d') ?>" /></td></tr>
 <tr><td style="font-weight: bold;">Patient Sponsor:</td>
 <td><input type="text" readonly="readonly" id="apatspon" name="apatspon" class="vasplus_blog_form_opt"/></td></tr>
</table>
</div><div id="image_bg" align="left" style="float:left; width: 180px; height: 160px;"></div></div></div>
<br clear="all" />
<!---------------------------------------end of register marking------------------------------------------>
<div id="booking" style="display: none; text-align: center; width: auto;">
<div align="left" style ="float:left;font-weight:bold;">
Patient Booking #: <input type="text" id="receipt" name="receipt" readonly="readonly"/> </div> <div class="vpb_lebels_fields" align="right">
<button id="bsavem" name="bsavem" type="submit" class="btn btn-primary" title="save record"><i class='icon-white icon-ok'></i></button>
<button id="brefresh" name="brefresh" type="submit" class="btn btn-primary" title="refresh form"><i class='icon-white icon-refresh'></i></button> <!--<button id="blist" name="blist" type="submit" class="btn btn-primary" title="back to list"><i class='icon-white icon-list'></i></button>--></div>
<br /><hr style="width: 850px;" /><div align="left" style="width: 880px; height: 400px; overflow: scroll;"><div align="left" style="float:left; width: 600px;">
<table cellspacing="2px" id="mtable">
<tr><td style="font-weight: bold;">Patient ID:</td><td><input type="text" name="bpatid" id="bpatid" readonly="readonly" class="vasplus_blog_form_opt" /></td></tr>
 <tr><td style="font-weight: bold;">Patient Name:</td><td><input type="text" name="bpatname" id="bpatname" readonly="readonly" class="vasplus_blog_form_opt" /></td></tr>
 <tr><td style="font-weight: bold;">Attendance Date:</td><td><input type="text" name="bpatdate" id="bpatdate" readonly="readonly" value="<?php echo date('Y-m-d') ?>" /></td></tr>
 <tr><td style="font-weight: bold;">Patient Sponsor:</td>
 <td><input type="text" readonly="readonly" id="bpatspon" name="bpatspon" class="vasplus_blog_form_opt"/></td></tr>
<tr><td style="font-weight: bold;">Decision:</td><td><select name="decision" id="decision">
	 <option value="New">New</option><option value="Follow-up">Follow-up</option></select></td></tr>
	 <tr><td style="font-weight: bold;">Clinician (Si):</td>
	 <td><select name="clinician" id="clinician"> <?php //select available clinicians
		$sdata=mysql_query("select a.logname,a.uname,b.p_id from s_users a,s_profile b where b.p_id='2' and 
		a.p_id = b.p_id and b.status like 'active' order by a.uname") or die(mysql_error()); while ($si=mysql_fetch_array($sdata)){
			echo '<option value="'.$si[0].'">'.$si[1].'</option>';	} ?></select></td></tr>	
<tr><td style="font-weight: bold;">Problem:</td><td><select name="probid" id="probid">';
<?php $mydata=mysql_query("select prob_id,problem from problem_type where status like 'active' order by problem") or die(mysql_error());
	while ($rows=mysql_fetch_array($mydata)){ 
 echo '<option value="'.$rows[0].'">'.$rows[1].'</option>'; } ?>
 </select> <input type="text" name="duration" id="duration" maxlength="20" style="width: 110px" placeholder="Problem Duration" /> <a id="addmore" href="#" class="btn btn-primary" title="add more problems"><i class="icon-white icon-plus"></i></a><input type="hidden" id="probs" 
 name="probs" value="0"/>
</td></tr>
</table></div><div id="img_bg" align="left" style="float:left; width: 160px; height: 140px;"></div>
</div></div> <br clear="all" />
<!---------------------------------------------end of register booking for doctors---------------------------------------------------->
<?php 
if (isset($_POST['bsavem'])){ //save booked patients record for attendance
$mydata=mysql_query("update pat_attendance set si='".$_POST['clinician']."',
 nw_fl='".$_POST['decision']."' where attend_id='".$_POST['receipt']."'") or die(mysql_error());
 if ($_POST['probs']>0) { // checking to save patient problems if the data user input else skip if no porblem specified 
 	for ($i=0;$i<count($_POST['problems']);$i++){
 	$mydata=mysql_query("insert into patient_problems values ('".$_POST['receipt']."',
	'".$_POST['bpatid']."','".$_POST['problems'][$i]."','".$_POST['durations'][$i]."')") or die (mysql_error());}}	
 	echo '<div id="msg" class="info" style="width: auto;">'.$_POST['bpatname'].' attendance register completed successfully awaiting clinical observation entry.</div>';}
	if (isset($_POST['savem'])){ //generating receipt number for attendance
	$atdata=mysql_query("select * from pat_att_gen where att_year='".date('Y')."'") or die(mysql_error());
	if (mysql_num_rows($atdata)<=0){ // save new attendance for the new year
	$atdata=mysql_query("insert into pat_att_gen values ('".date('Y')."','1')") or die(mysql_error());
	}else { //update the receipts for attendance
	$atdata=mysql_query("update pat_att_gen set att_count=att_count+1 where att_year='".date('Y')."'") or die (mysql_error());}
	$atdata=mysql_query("select * from pat_att_gen where att_year='".date('Y')."'") or die(mysql_error());
	$yrid=0;$cttid=0;
	 //now select the new attendance id
			while($rid=mysql_fetch_array($atdata)){ $newid=$rid[1]; $yrid=$rid[0];$cttid=$rid[1]; }
	if ($newid<10){$newid='00'.$yrid.'00'.$cttid;} elseif($newid<100){$newid='00'.$yrid.'0'.$cttid;}else{$newid='00'.$yrid.$cttid;} 
	//now save the generated receipt for the patient...
	$att_data=mysql_query("insert into pat_attendance values ('".$newid."','".$_POST['apatid']."','nsi','',
	'".$_POST['apatdate']."','".date('h:i:s a')."','NYD','".$_SESSION['logname']."')") or die(mysql_error()); ?>
	<div class="info" id="msg" style="width:auto;"><?php echo $_POST['apatname'] ?> registered for <?php echo $_POST['apatdate'] ?>
 with Rececipt #: <?php echo  $newid ?></div> <?php } ?>
<div id="vasplus_programming_blog_wrapper" style="text-align: center; font-family:Times New Roman; font-size:16px;"><br />
<div align="left" style ="float:left;font-weight:bold;">
Find Patient Data:</div> <div class="vpb_lebels_fields" align="right">
<button id="find" name="find" tabindex="1" type="submit" class="btn btn-primary" title="find record"><i class='icon-white icon-search'></i></button></div>
<br /><hr />
<div class="vpb_lebels" align="left" style ="float:left;">Criteria:</div>
<div class="vpb_lebels_fields" align="left">
<select name="pcrit" id="pcrit" class="vasplus_blog_form_opt">
	<option value="like">Contains</option>
	<option value="BookedPatients">Booked Patients</option>
	<option value="=">Equals</option>
	<option value="!=">Not Equals</option>
	<option value="like">Starts With</option>
	</select></div><br clear="all">
<div class="vpb_lebels" align="left" style ="float:left;">Name of Patient:</div>
<div id="mval" class="vpb_lebels_fields" align="left">
<input type="text" name="recname" id="recname" class="vasplus_blog_form_opt" placeholder="Enter Patient Name" /></div><br clear="all"><br clear="all">
<br clear="all"></div> <div id="reload_records">
<?php
 if (isset($_POST['refresh'])){ ?> <script>$('#vasplus_programming_blog_wrapper').slideUp('fast');</script> 
<?php goto dataRecords; exit();}
elseif (isset($_POST['find'])) { ?><script>$('#vasplus_programming_blog_wrapper').slideUp('fast');</script>
<div id="load_problem">
<?php	if ($_POST['pcrit']=='BookedPatients' && !empty($_POST['recname'])){  //search for booked patients  
  $mydata = mysql_query("SELECT a.*,(select b.sp_name from pat_spon b,patient_details c where c.p_id=a.p_id and c.sp_id=b.sp_id) as pat_sponsor,
  d.attend_id from patients a,pat_attendance d where a.p_id=d.p_id and d.doa='".$_POST['recname']."'
   order by d.doa desc,d.t_in desc") or die(mysql_error());	$msg="Records for ";}
  elseif ($_POST['pcrit']=='BookedPatients' && empty($_POST['recname'])){  //search for booked patients  
  $mydata = mysql_query("SELECT a.*,(select b.sp_name from pat_spon b,patient_details c where c.p_id=a.p_id and c.sp_id=b.sp_id) as pat_sponsor,
  d.attend_id from patients a,pat_attendance d where a.p_id=d.p_id and d.si='nsi' order by d.doa desc,d.t_in desc") 
  or die(mysql_error());	$msg="Records for ";}
	elseif (isset($_POST['recname']) && !empty($_POST['recname']) && $_POST['pcrit']!='BookedPatients'){ //load problem by clicking find button
	$msg="Records for Patients that";	
	if ($_POST['operand']=='Contains'){ 
$mydata = mysql_query("SELECT a.*,(select b.sp_name from pat_spon b,patient_details c where c.p_id=a.p_id and c.sp_id=b.sp_id) as pat_sponsor
  from patients a where concat(a.fname,' ',a.surname) ".$_POST['pcrit']." '%".$_POST['recname']."%'  and a.status like 'active'
  order by concat(a.fname,' ',a.surname)") or die(mysql_error());	
		}elseif ($_POST['operand']=='Starts With'){ 
$mydata = mysql_query("SELECT a.*,(select b.sp_name from pat_spon b,patient_details c where c.p_id=a.p_id and c.sp_id=b.sp_id) as pat_sponsor
  from patients a where concat(a.fname,' ',a.surname) 
 ".$_POST['pcrit']." '".$_POST['recname']."%' and a.status like 'active' order by concat(a.fname,' ',a.surname)") or die(mysql_error());	
		}else {
$mydata = mysql_query("SELECT a.*,(select b.sp_name from pat_spon b,patient_details c where c.p_id=a.p_id and c.sp_id=b.sp_id) as pat_sponsor
  from patients a where concat(a.fname,' ',a.surname) ".$_POST['pcrit']." '".$_POST['recname']."' and a.status like 'active'
   order by concat(a.fname,' ',a.surname)") or die(mysql_error()); }
 ?>
 <div class="info" id="pop" style="width: auto;"><?php  echo $msg.' '.$_POST['operand'].': '. $_POST['recname']; ?></div> <br />
<?php }else { //load unbooked patients when user click refresh to load all records or load patients not assigned to doctors
	dataRecords:
$mydata = mysql_query("SELECT a.*,(select b.sp_name from pat_spon b,patient_details c where c.p_id=a.p_id and c.sp_id=b.sp_id) as pat_sponsor
  from patients a where a.status like 'active' order by concat(a.fname,' ',a.surname)") or die(mysql_error());}?> 
	<script>$('#vasplus_programming_blog_wrapper').slideUp('fast');</script>
<a id="add_pro" class="btn btn-primary" title="add new data" href="#"><i class='icon-white icon-plus'></i></a>
<button id="refresh" name="refresh" type="submit" class="btn btn-primary" title="refresh form"><i class='icon-white icon-refresh'></i></button>
<!--<a id="refresh" class="btn btn-primary" title="refresh form" href="#"><i class='icon-white icon-retweet'></i></a>-->
<a id="ifind" class="btn btn-primary" title="find data" href="#"><i class='icon-white icon-search'></i></a><br />
<p id="msg" style="width: auto;"></p><br />
<div id="reload_table">
 <div style="font-weight: bold;">Number of Records Found: <?php echo mysql_num_rows($mydata); ?> </div>
 <?php if(mysql_num_rows($mydata)<=0){exit();} ?><br /><div style="height:440px; overflow: scroll;">
 <table style="width: auto; cursor: pointer;" cellpadding="0" cellspacing="0" border="0" 
 class="table table-striped table-bordered" id="maintbl" style="font-family: monospace; font-size: large;">
		<thead id="banner" style="cursor: pointer;">
        <tr><th>ID:</th><th>Title:</th><th>Patients First Name:</th><th>Patients Surname:</th>
		<th>Gender:</th><th>Sponsor:</th>
                <th style="text-align:center; width: auto;">Action</th>
            </tr></thead>
           <tbody><?php	
			while($record = mysql_fetch_array($mydata)) { 
			 $id=$record[0]; ?>
            <tr class='user' id='<?php echo $record[0]; ?>'>
                <td class="p_id"><?php echo $record[0] ?></td>
                <td class="ptitle"><?php echo $record[1] ?></td>
				<td class="pfname"><?php echo $record[2] ?></td>
				<td class="psurname"><?php echo $record[3] ?></td>
				<td class="pgender"><?php echo $record[4] ?></td>
				<td class="psponsor"><?php echo $record[8] ?></td>
                <td class="regid" style='text-align:center;'>
	<?php $validate=mysql_query("select p_id,attend_id from pat_attendance where p_id='".$record[0]."' and si='nsi'") or die(mysql_error());
   					if (mysql_num_rows($validate)>0){ while ($att=mysql_fetch_array($validate)){ ?> 
				<div class="td_1"><?php echo $att[1] ?></div>
  <a class="delete btn btn-primary" title='delete <?php echo $record[1].' '.$record[2].' '.$record[3]; ?> from register' 
   href="#" ><i class='icon-white icon-trash'></i></a> <a class="assign btn btn-primary" title='assign <?php echo $record[1].' '.$record[2].' '.$record[3]; ?> to a doctor' 
  href="#" ><i class='icon-white icon-user'></i></a>
   <?php } } else { ?>
   	  <a class="register btn btn-primary" title='register <?php echo $record[1].' '.$record[2].' '.$record[3]; ?> for attendance' 
   href="#" ><i class='icon-white icon-edit'></i></a>
  <?php } ?>
        </td></tr>    
<?php 	} ?>  </tbody>
<!--End Loading Data From Database-->
		</table></<div></div></div></div><?php  } ?></div></div>
		<div id="delete_register" title="Delete Data">
        <div class="control-group"><label id="pname" class="control-label"></label>
            <div class="controls"><input type="hidden" name="id2" id="id2"/><input type="hidden" id="lb2" name="lb2"/></div></div></div> 
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