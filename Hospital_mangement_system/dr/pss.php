<?php
include_once ('../lib/library.php');
if ($_SESSION['mtuid']==""){ 
 header ('Location: ../.');
    exit();} $pagename='pss'; $pagegroup='dr';	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Patient Sponsors Data</title>
<link rel="icon" href="../images/lg.png" />
<link href="../css/jquery-ui-1.10.0.custom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.css" type="text/css"/> 
<link rel="stylesheet" href="../css/jquery.qtip.min.css" type="text/css"/>
<link rel="stylesheet" href="../lib/screen.css" type="text/css" />
<script src="../js/jquery.js" type="text/javascript"></script>
<link rel="stylesheet" href="../css/style.css" type="text/css" />
<script src="../js/bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
<script type="text/javascript" src="js/sponsors.js"></script>
<script src="../js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.qtip.min.js"></script>
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
			$('#recname').click(function(){
				$('#msg').slideUp();
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
    <div id="add_data" title="Add Data" style="display: block">
            <div class="control-group">
                    <label class="control-label">Sponsor Name*:</label>
<div class="controls">
       <input required="required" maxlength="50" title="Enter text only." type="text" name="aspname" placeholder="Sponsor Name" id="aspname" /></div></div>
	<div class="control-group">
                    <label class="control-label">Sponsor Details*:</label>
<div class="controls">
      <input required="required" maxlength="50" title="Enter text only." type="text" name="aspdetail" placeholder="Sponsor Details" id="aspdetail" /></div></div>
<div class="control-group">
                    <label class="control-label">Date Captured:</label>
<div class="controls">
    <input required="required" value="<?php echo date('Y-m-d'); ?>" type="date" name="aspdate" readonly="readonly" id="aspdate" /></div></div>
	<div class="control-group">
                    <label class="control-label">Inputter:</label>
<div class="controls">
       <input required="required" value="<?php echo $_SESSION['usname']; ?>" type="text" name="aspinput" readonly="readonly" id="aspinput" /></div></div></div>
    <div id="edit_data" title="Edit Data" style="display: block">
<div class="control-group">
             <label class="control-label">ID :</label>
                <div class="controls">
                    <input readonly="readonly" title="Not editable..." type="text" name="espid" id="espid"/>
                </div> </div>          
  <div class="control-group">
                    <label class="control-label">Sponsor Name*:</label>
<div class="controls">
       <input required="required" title="Enter text only." type="text" name="espname" placeholder="Sponsor Name" id="espname" /></div></div>
	<div class="control-group">
                    <label class="control-label">Sponsor Details*:</label>
<div class="controls">
 <input required="required" title="Enter text only." type="text" name="espdetail" placeholder="Sponsor Details" id="espdetail" /></div></div>
 <div class="control-group">
                    <label class="control-label">Inputter:</label>
<div class="controls">
       <input required="required" title="Enter text only." type="text" name="espinputter" readonly="readonly" id="espinputter" /></div></div>
	
 				</div>
 
    <div id="delete_data" title="Delete Sponsor">
        <div class="control-group">
        <label id="dspname" class="control-label"></label>
                <div class="controls">
                    <input type="hidden" name="id2" id="id2"/>
                    <input type="hidden" id="lb2" readonly="readonly" name="lb2"/>
                </div></div></div> 
				   
<div id="d2" title="Data" style="display:none;">
	<p><font color="red">All fields are required...!</font></p></div>	
<div id="vasplus_programming_blog_wrapper" style="text-align: center; font-family:Times New Roman; font-size:16px;"><br />
<div align="left" style ="float:left;font-weight:bold;">
Find Patient Sponsors:</div> <div class="vpb_lebels_fields" align="right">
<a id="add_pros" class="btn btn-primary" title="add new data" href="#"><i class='icon-white icon-plus'></i></a>
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
<div class="vpb_lebels" align="left" style ="float:left;">Name of Sponsor:</div>
<div class="vpb_lebels_fields" align="left">
<input type="text" name="recname" id="recname" placeholder="Enter Sponsor Name" class="vasplus_blog_form_opt" /></div><br clear="all"><br clear="all">
<br clear="all">
<div class="vpb_lebels" align="left">&nbsp;</div>
<br clear="all"></div><div id="reload_records">
<?php
 if (isset($_POST['refresh'])){ ?> <script>$('#vasplus_programming_blog_wrapper').slideUp('fast');</script> 
<?php goto dataRecords; exit();}
elseif (isset($_POST['find'])) { ?><script>$('#vasplus_programming_blog_wrapper').slideUp('fast');</script>
<div id="load_problem">
<?php  if (isset($_POST['recname']) && !empty($_POST['recname'])){ //load data when user posts problem by clicking find button
		if ($_POST['operand']=='Contains'){
$mydata = mysql_query("SELECT a.sp_id,a.sp_name,a.sp_details,a.sp_date,a.status,b.uname from pat_spon a,s_users b where a.inputter=b.logname
 and a.sp_name like '%".$_POST['recname']."%'  order by a.sp_name") or die(mysql_error());	
		}elseif ($_POST['operand']=='Starts With'){
$mydata = mysql_query("SELECT a.sp_id,a.sp_name,a.sp_details,a.sp_date,a.status,b.uname from pat_spon a,s_users b where a.inputter=b.logname
 and a.sp_name like '".$_POST['recname']."%' order by a.sp_name") or die(mysql_error());	
		}else {
$mydata = mysql_query("SELECT a.sp_id,a.sp_name,a.sp_details,a.sp_date,a.status,b.uname from pat_spon a,s_users b where a.inputter=b.logname
 and a.sp_name ".$_POST['pcrit']." '".$_POST['recname']."' order by a.sp_name") or die(mysql_error()); }
 ?>
 <div class="info" id="pop" style="width: auto;">Records for Sponsors that <?php  echo $_POST['operand'].': '. $_POST['recname']; ?></div> <br />
<?php }else { //load data when user click refresh to load all records
	dataRecords:
$mydata = mysql_query("SELECT a.sp_id,a.sp_name,a.sp_details,a.sp_date,a.status,b.uname from pat_spon a,s_users b 
where a.inputter=b.logname and a.status like 'active' order by a.sp_name") or die(mysql_error());}?> 
 
<a id="add_pro" class="btn btn-primary" title="add new data" href="#"><i class='icon-white icon-plus'></i></a>
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
        <tr>	<th>ID:</th><th>Name of Sponsor:</th><th style="text-align: center;">Sponsor Details:</th>
		<th style="text-align: center;">Date Captured:</th><th style="text-align: center;">Record Status:</th>
		<th style="text-align: center;">Inputter:</th>
                <th style="text-align:center; width: auto;">Action</th>
            </tr></thead>
           <tbody>
<?php
			while($record = mysql_fetch_array($mydata)) { 
			 $id=$record[0]; ?>
            <tr class='user' id='<?php echo $record[0]; ?>'>
                <td class="spid" style="text-align:center;"><?php echo $record[0] ?></td>
                <td class="spname"><?php echo $record[1] ?></td>
				<td class="spdetail" style="text-align: center;"><?php echo $record[2] ?></td>
				<td class="spdate" style="text-align: center;"><?php echo $record[3] ?></td>
				<td class="spstatus" style="text-align: center;"><?php echo $record[4] ?></td>
				<td class="spinputter" style="text-align: center;"><?php echo $record[5] ?></td>
                <td style='text-align:center; width: auto;'>
                <a class="edit btn btn-primary" title='edit <?php echo $record[1]; ?> record...' href="#" ><i class='icon-white icon-pencil'></i></a>
                    &nbsp;|&nbsp;
                <a class="delete btn btn-primary" title='delete <?php echo $record[1]; ?> record...' href='#'><i class='icon-white icon-trash'></i></a>
				   
                
                </td>
            </tr>
            
<?php
       	 	}
?>  </tbody>
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