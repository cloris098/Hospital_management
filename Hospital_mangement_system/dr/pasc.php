<?php
include_once ('../lib/library.php');
if ($_SESSION['mtuid']==""){ 
 header ('Location: ../.');
    exit();} $pagename='pasc'; $pagegroup='dr';	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Product Service Category</title>
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
<script src="js/category.js" type="text/javascript" ></script>
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
	
	$('#ifind').click(function(){ 
	$('#reload_records').slideUp('fast');
	$('#vasplus_programming_blog_wrapper').slideDown('slow');
	});
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
<div id="tabs"><ul><li><a href="#tabs-1">Product & Service Category:-</a></li></ul><br />
	   <div id="add_data" title="Add Data" style="display: block">
            <div class="control-group"><label class="control-label">Product & Service Category*:</label><div class="controls">
<input required="required" maxlength="60" title="Enter text only." type="text" name="categ_name" 
 placeholder="Category Name" id="categ_name" /></div></div>
	<div class="control-group"><label class="control-label">Date Captured:</label>
<div class="controls">
    <input value="<?php echo date('Y-m-d'); ?>" type="text" name="categ_date" readonly="readonly" id="categ_date" /></div></div>
	<div class="control-group"><label class="control-label">Inputter:</label>
<div class="controls">
<input required="required" value="<?php echo $_SESSION['usname']; ?>" type="text" readonly="readonly" id="categ_inputter" /></div></div></div>

<div id="edit_data" title="Edit Data" style="display: block">
<div class="control-group"><label class="control-label">Product & Service ID*:</label><div class="controls">
<input required="required" title="Enter text only." type="text" name="ecateg_id" 
 placeholder="Category Name" id="ecateg_id" readonly="readonly" /></div></div>
            <div class="control-group"><label class="control-label">Product & Service Category*:</label><div class="controls">
<input required="required" maxlength="60" title="Enter text only." type="text" name="ecateg_name" 
 placeholder="Category Name" id="ecateg_name" /></div></div>
	<div class="control-group"><label class="control-label">Date Captured:</label>
<div class="controls">
    <input type="text" name="ecateg_date" readonly="readonly" id="ecateg_date" id="ecateg_date" /></div></div>
	<div class="control-group"><label class="control-label">Inputter:</label>
<div class="controls">
<input required="required" type="text" readonly="readonly" value="<?php echo $_SESSION['usname']; ?>" id="ecateg_inputter" name="ecateg_inputter" /></div></div></div>

    <div id="delete_data" title="Delete Data">
        <div class="control-group">
        <label id="category" class="control-label"></label>
            <div class="controls">
            <input type="hidden" name="id2" id="id2"/>
                    <input type="hidden" id="lb2" readonly="readonly" name="lb2"/></div></div></div>
	<div id="d2" title="Data Administration..." style="display:none;">
	<p><font color="red">All fields are required...!</font></p></div> 

<div id="vasplus_programming_blog_wrapper" style="text-align: center; font-family:Times New Roman; font-size:16px;"><br />
<div align="left" style ="float:left;font-weight:bold;">
Find Category:</div> <div class="vpb_lebels_fields" align="right">
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
<div class="vpb_lebels" align="left" style ="float:left;">Category Name:</div>
<div class="vpb_lebels_fields" align="left">
<input type="text" name="recname" id="recname" placeholder="Enter Category Name" class="vasplus_blog_form_opt" />
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
$mydata = mysql_query("SELECT a.*,b.uname from pro_categ a,s_users b where a.categ_name ".$_POST['pcrit']." '%".$_POST['recname']."%'
 and b.logname=a.inputter order by a.categ_name") or die(mysql_error());	
		}elseif ($_POST['operand']=='Starts With'){ 
$mydata = mysql_query("SELECT a.*,b.uname from pro_categ a,s_users b where a.categ_name ".$_POST['pcrit']." '".$_POST['recname']."%'
  and a.inputter=b.logname order by a.categ_name") or die(mysql_error());	
		}else {
$mydata = mysql_query("SELECT a.*,b.uname from pro_categ a,s_users b where a.categ_name ".$_POST['pcrit']." '".$_POST['recname']."'
  and a.inputter=b.logname order by a.categ_name") or die(mysql_error()); }
 ?>
 <div class="info" id="pop" style="width: auto;">Records for Product & Service Category that <?php  echo $_POST['operand'].': '. $_POST['recname']; ?></div> <br />
<?php }else { //load data when user click refresh to load all records
	dataRecords:
$mydata = mysql_query("SELECT a.*,b.uname from pro_categ a,s_users b where a.status like 'active' 
 and a.inputter=b.logname order by a.categ_name") or die(mysql_error());}?> 
 <div id="reload_records">
<a id="add_data_btn" class="btn btn-primary" title="add new data" href="#"><i class='icon-white icon-plus'></i></a>
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
        <tr><th>ID:</th><th>Product & Service Category:</th><th>Date Captured:</th><th>Inputter:</th>
		<th>Status:</th><th style="text-align:center; width: auto;">Action</th>
            </tr></thead>
           <tbody>
<?php		while($record = mysql_fetch_array($mydata)) { 
			 $id=$record[0]; ?>
            <tr class='user' id='<?php echo $record[0]; ?>'>
                <td class="categ_id"><?php echo $record[0] ?></td>
                <td class="categ_name"><?php echo $record[1] ?></td>
				<td class="categ_date"><?php echo $record[2] ?></td>
				<td class="inputter"><?php echo $record[5] ?></td>
				<td class="status"><?php echo $record[4] ?></td>
				<td style='text-align:center;'>
  <a class="edit btn btn-primary" title='edit <?php echo $record[1]; ?> record...' 
   href="#" ><i class='icon-white icon-pencil'></i></a>
                    &nbsp;|&nbsp;
  <a class="delete btn btn-primary" title='delete <?php echo $record[1]; ?> record...' href='#'><i class='icon-white icon-trash'></i></a>
  &nbsp;|&nbsp;
  <a class="print btn btn-primary" title='print <?php echo $record[1]; ?> record...' 
  href="javascript:nw('printpasc?print=<?php echo base64_encode($record[0]);  ?>');"><i class='icon-white icon-print'></i></a> 
                </td></tr><?php } ?></tbody></table></div></div></div></div><?php  } ?>
	<script type="text/javascript">	
function nw(url){
    var newwin;
	newwin = window.open(url,'','height=300,width=750,top=20,left=70,scrollbars=yes,location=no,toolbar=no');
    if (window.focus) {newwindow.focus();}   
}</script>
</div></div>
</form>
</body>
</html>