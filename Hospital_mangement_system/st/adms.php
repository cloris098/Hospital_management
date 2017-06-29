<?php
include_once ('../lib/library.php');
if ($_SESSION['mtuid']==""){ 
 header ('Location: ../.');
    exit();} $pagename='adms'; $pagegroup='st';	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Profile Administration</title>
<link rel="icon" href="../images/lg.png" />
<link href="../css/jquery-ui-1.10.0.custom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.css" type="text/css"/> 
<link rel="stylesheet" href="../css/jquery.qtip.min.css" type="text/css"/>
<link rel="stylesheet" href="../lib/screen.css" type="text/css" />
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../js/DT_bootstrap.js"></script>
<script type="text/javascript" src="js/myjquery.js"></script>
<script src="../js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.qtip.min.js"></script>
	<script>
	$(function() {
		$( "#accordion" ).accordion({
			heightStyle: "content"
		});	});</script>
<style>
#dvLoading{background: url(../images/loading.gif) no-repeat center center;
   height: 50px; width: 100px; position: fixed; z-index: 1000; left: 50%; top: 30%; margin: -25px 0 0 -25px;}</style>
<script>
$(window).load(function(){
  $('#dvLoading').fadeOut(1000);
});
$(document).ready(function(){
	$('#refresh').click(function(){
		windows: location = '../st/adms';
	});	
});
</script>
<?php include_once ('../lib/popclose.php'); ?>
</head>
<body style="background: white;" onload="StartTimers();" onmousemove="ResetTimers();" onmousedown="disablecopy();" oncontextmenu="return false" oncopy="return false" onpaste="return false" oncut="return false">
<form action="adms" method="post">
<h2 id="banner"><div style="width: auto; float: left;"><img src="../images/mt.png" style="width: 10%; height: 8%;"/>
WELCOME to: <?php echo $_SESSION['app']; ?> </div>
	<div style="float: right; width: 15%;"><p>
	</p></div>	<br /> </h2><hr />
<div id="dvLoading"></div>
<div class="modal-header">
<a id="add_pro" class="btn btn-primary" title=" add new profile" href="#"><i class='icon-white icon-plus'></i></a>
<button id="refresh" class="btn btn-primary" title="refresh form"><i class='icon-white icon-refresh'></i></button>
<br />
<!--//////////////////////////////// Add Dialog ///////////////////////////////////////////-->
    <div id="add_profile" title="Add Profile" style="display: block">
            <div class="control-group">
                    <label class="control-label">New Profile Name :</label>
                <div class="controls">
          <input required="required" title="Enter text only." type="text" name="pname" placeholder="Profile Name" id="pname" />
                </div>
            </div>
			<div class="control-group">
                    <label class="control-label">Log-Out Time :</label>
                <div class="controls">
 <input required="required" title="Enter minutes in number." type="text" name="timeout" placeholder="Profile Log-Out Time" id="timeout" />
                </div>
            </div>
    </div>

<!--//////////////////////////////// Edit Dialog ///////////////////////////////////////////-->
    <div id="edit_profile" title="Edit Profile" style="display: block">
<div class="control-group">
             <label class="control-label">Profile ID :</label>
                <div class="controls">
                    <input readonly="readonly" title="Not editable..." type="text" name="pid" placeholder="Profile Name" id="pid"/>
                </div>
            </div>          
  <div class="control-group">
             <label class="control-label">Profile Name :</label>
                <div class="controls">
                    <input required="required" title="Enter text only." type="text" name="pname1" placeholder="Profile Name" id="pname1"/>
                </div>
            </div>
	<div class="control-group">
                    <label class="control-label">Log-Out Time :</label>
                <div class="controls">
 <input required="required" title="Enter minutes in number." type="text" name="timeouts" placeholder="Profile Log-Out Time" id="timeouts" />
                </div>
            </div>
    </div>
    
<!--//////////////////////////////////// Delete Dialog ///////////////////////////////////////-->
    <div id="delete_profile" title="Delete Profile">
        <div class="control-group">
        <label class="control-label">Are you sure you want to delete this record?</label>
                <div class="controls">
                    <input type="hidden" name="id2" id="id2"/>
                    <input type="text" readonly="readonly" name="lb2"/>
                </div>
        </div>  
    </div>    
<!--////////////////////////////////// Checking Fill Dialog ///////////////////////////////////-->
<div id="d2" title="Profile Administration..." style="display:none;">
	<p><font color="red">All fields are required...!</font></p>
</div>

<br />
<!--Loading Data From Database-->

<?php 
$mydata = mysql_query("SELECT b.p_id,b.p_name,b.status,b.logtime,
 (select count(a.p_id) from s_users a where a.p_id=b.p_id and a.p_id>0) from s_profile b
	 where b.p_id>0 order by p_name") or die(mysql_error());
?> <div style="height:440px; overflow: scroll;">  
 <table style="width: 950px; cursor: pointer;" cellpadding="0" cellspacing="0" border="0" 
 class="table table-striped table-bordered" id="example" style="font-family: monospace; font-size: large;">
		<thead id="banner" style="cursor: pointer;">
        <tr> 
				<th style="text-align:center;">Profile ID</th>
                <th>Profile Name</th>
				<th>Profile Status</th><th>Log-Out Time (mins)</th>
				<th title="number of users with that profile">Profile Count</th>
                <th style="text-align:center; width: auto;">Action</th>
            </tr></thead>
           <tbody>
<?php
			while($record = mysql_fetch_array($mydata)) { 
			 $id=$record[0]; ?>
            <tr class='user' id='<?php echo $record[0]; ?>'>
                <td class="pid" style="text-align:center;"><?php echo $record[0] ?></td>
                <td class="pname"><?php echo $record[1] ?></td>
				<td class="status" style="text-align: center;"><?php echo $record[2] ?></td>
				<td class="logout" style="text-align: center;"><?php echo $record[3]/60000; ?></td>
				<td class="usercount" style="text-align: center;"><?php echo $record[4] ?></td>
                <td style='text-align:center; width: auto;'>
    <a class="edit btn btn-primary" title='edit <?php echo $record[1]; ?> profile menu...' href="#" ><i class='icon-white icon-pencil'></i></a>
                    &nbsp;|&nbsp;
   <a class="delete btn btn-primary" title='delete <?php echo $record[1]; ?> profile menu...' href='#'><i class='icon-white icon-trash'></i></a>
				    &nbsp;|&nbsp;
                <a class="assign btn btn-primary" title='assign menus to <?php echo $record[1]; ?> profile menu...'
href="javascript:nw('edit?pid=<?php echo $record[0]; ?>');"><i class='icon-white icon-home'></i></a>
                
                </td>
            </tr>
            
<?php
       	 	}
?>  </tbody>
<!--End Loading Data From Database-->
		</table></div>
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