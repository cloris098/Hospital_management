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
});
  </script>
<?php include_once ('../lib/popclose.php'); ?>
</head>
<body style="background: white;" onload="StartTimers();" onmousemove="ResetTimers();" onmousedown="disablecopy();" oncontextmenu="return false" oncopy="return true" onpaste="return true" oncut="return false" onkeydown="return (event.keyCode != 116)">
<form action="<?php $_SERVER['PHP_SELF']; ?>" id="fname">
<input type="hidden" value="Contains" name="operand" id="operand" />
<h2 id="banner"><div style="width: auto; float: left;"><img src="../images/mt.png" style="width: 10%; height: 8%;"/>
WELCOME to: <?php echo $_SESSION['app']; ?> </div>	<br /> </h2><hr />
<div id="dvLoading"></div>
<div class="modal-header">
<div id="tabs"><ul><li><a href="#tabs-1">Product & Service Category Report:-</a></li></ul><br />
<?php $mydata = mysql_query("SELECT a.*,c.categ_name,b.uname from pro_categ c,s_users b,pro_service a where a.status like 'active' 
 and a.inputter=b.logname and a.categ_id=c.categ_id and a.categ_id='".base64_decode($_GET['print'])."'
  order by a.pro_name,c.categ_name") or die(mysql_error());	?> 
 <div style="font-weight: bold;">Number of Records Found: <?php echo mysql_num_rows($mydata); ?> </div>
 <?php if(mysql_num_rows($mydata)<=0){exit();} ?><br />
 <table style="width: auto; cursor: pointer;" cellpadding="0" cellspacing="0" border="0" 
 class="table table-striped table-bordered" id="maintbl" style="font-family: monospace; font-size: large;">
		<thead id="banner" style="cursor: pointer;">
        <tr><th>ID:</th><th>Product / Service :</th><th>Item Cost:</th><th>Date Captured:</th>
		<th>Status:</th><th>Category:</th><th>Inputter:</th></tr></thead> <tbody>
<?php		while($record = mysql_fetch_array($mydata)) { 
			 $id=$record[0]; ?>
            <tr class='user' id='<?php echo $record[0]; ?>'>
                <td class="pro_id"><?php echo $record[0] ?></td>
                <td class="pro_name"><?php echo $record[1] ?></td>
				<td class="pro_cost"><?php echo $record[2] ?></td>
				<td class="pro_date"><?php echo $record[3] ?></td>
				<td class="pro_status"><?php echo $record[4] ?></td>
				<td class="pro_categ"><?php echo $record[7] ?></td>
				<td class="pro_inputter"><?php echo $record[8] ?></td>
			</tr><?php } ?></tbody></table></div></div>
</form>
</body>
</html>