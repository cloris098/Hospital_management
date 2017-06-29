<?php
 include_once ('../lib/library.php');
if ($_SESSION['mtuid']==""){ 
 header ('Location: ../.');
    exit();} $pagename='patward'; $pagegroup='dr';	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Page Name</title>
<link rel="icon" href="../images/flag.png" />
<link href="../css/jquery-ui-1.10.0.custom.css" rel="stylesheet" type="text/css" />
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

<style>
#loader{  background: url(../images/loading.gif) no-repeat center center;
   height: 50px; width: 100px;   position: fixed; z-index: 1000;
   left: 50%;top: 30%;   margin: -25px 0 0 -25px;}</style>
<script type="text/javascript">
var timoutWarning = 500000; // Display warning in 14 sec.
var timoutNow =  600000; //|| Timeout: 1000 is 1 secs.
var warningTimer;	var timeoutTimer;
function StartTimers() {warningTimer = setTimeout("IdleWarning()", timoutWarning);	timeoutTimer = setTimeout("IdleTimeout()", timoutNow);}
function ResetTimers() {clearTimeout(warningTimer);	clearTimeout(timeoutTimer);	StartTimers();}
function IdleTimeout() {self.close();}
$(document).ready(function() {   
$("#menus").change(function() {
menuID=$.trim($("#menus").val()); menuName=$.trim($("#menus :selected").text());
pName=$.trim($("#pname").text()); 	$("#mname").val(menuName);	
		if (menuName=='--Select Menus--'){	exit();}
 $("#disp").remove();
$(this).after('<div id="loader"></div>');
$("#menulist tr:gt(2)").remove();
$.get('loadscript.php?menu=' + $(this).val(), function(data) {
$("#menulist").append('<tr id="clear"><td colspan="2" style="text-align:center; color:red;"><i><b>'+menuName+'</b></i>'+
'<input type="hidden" id="gmid" name="gmid" value="'+menuID+'" /></td></tr>');			
$("#menulist").last().append(data);
   var ctmenus=$('#menulist').find('tr').index()-3;
   $("#ctm").val(ctmenus);
			$('#loader').slideUp(200, function() {
				$(this).remove();
			});	});   });
	
$('#remove_menu').live('click', function() {
   $(this).parent().parent().remove();
   var ctmenus=$('#menulist').find('tr').index()-3;
   $("#ctm").val(ctmenus);
    return false; });

 });
</script>
<?php include_once ('../lib/popclose.php'); ?>
</head>
<body style="background: white;" onload="StartTimers();" onmousemove="ResetTimers();" onmousedown="disablecopy();" oncontextmenu="return false" oncopy="return false" onpaste="return false" oncut="return false">
<form action="<?php echo 'edit?pid='.$_GET['pid']; ?>" method="post" name="myform" id="myform">
<input type="hidden" name="ctm" id="ctm" value="-1"/><input type="hidden" name="mname" id="mname" value=""/>
<h2 id="banner"><div style="width: auto; float: left;"><img src="../images/mt.png" style="width: 10%; height: 8%;"/>
WELCOME to: <?php echo $_SESSION['app']; ?> </div>
	<div style="float: right; width: 15%;"><p>
	</p></div>	<br /> </h2><hr />
<div class="modal-header">
<?php if (isset($_POST['savem'])){//delete all menus related to the selected profile
if (empty($_POST['gmid']) || $_POST['ctm']==-1){ goto DisplayErr;}
$query=mysql_query("delete from sp_menus where sp_id='".$_POST['pid']."' and smg_id='".$_POST['gmid']."'") or die(mysql_error());
	$cpid=$_POST['ctm'];
	if ($cpid>0){ //dont save any empty menu records when all the menus are detached from the profile....
	$cpid=count($_POST['gid']);$pid=$_POST['pid'];$mid=$_POST['lmenus'];$gid=$_POST['gid'];$i=0;
	for($i=0;$i<$cpid;$i++){//saving the profile menu array 
$query=mysql_query("Insert into sp_menus (sp_id,sm_id,smg_id) values ('".$pid."','".$mid[$i]."','".$gid[$i]."')") or die(mysql_error());	}
 echo '<div id="disp" class="info" style="width:auto;">'.$ds[0].' '.$_POST['mname'].' saved successfully...</div>';	}
 	else {
		DisplayErr:	echo '<div id="disp" class="info" style="width:auto;">No menus selected for '.$_POST['pname'].' profile...</div>';	}	
} ?>
<!--//////////////////////////////////// Administer User Profile ///////////////////////////////////////-->
<button id="savem" name="savem" class="btn btn-primary" title="Save <?php echo $ds[0]; ?> Menu"><i class="icon-white icon-ok"></i></button>
<button id="refresh" class="btn btn-primary" title="refresh form"><i class='icon-white icon-retweet'></i></button>
<br /><br />
<table border="0" style="width: auto;" id="menulist">  
   <tr><td><div class="control-group">
              <label class="control-label">Profile Name :</label>
                <div class="controls">
				<input type="hidden" name="pid" id="pid" value="<?php echo $_GET['pid']; ?>"/>
      <input required="required" value="<?php echo $_SESSION['proname']= $ds[0]; ?>" readonly="readonly" type="text" name="pname" id="pname"/>
                </div>
   </td><td>
   <div class="control-group">
              <label class="control-label">System Menus :</label>
                <div class="controls">
                 <select id="menus" name="menus">
				 <option value="">-- Select Menus--</option>
				 	<?php
                $query = "SELECT mg_id,mg_name FROM s_menu_groups ORDER BY mg_name";
                        $result = mysql_query($query);  
                            while($row=mysql_fetch_array($result)){                                                 
							   echo "<option value='".$row[0]."'>".$row[1]."</option>";
							} ?>
				 </select> </div>
                  </td>  </tr>
	<tr style="color: red;">
	<td colspan="2" style="text-align: center;"><b>Available Menus</b></td></tr>	  
<tr><td><?php echo $ds[0]; ?> Menus</td><td style="text-align: center;">System Menus</td></tr>
</table>       
<br />
<script type="text/javascript">	
function nw(url){var newwin;
	newwin = window.open(url,'','height=500,width=850,top=20,left=50,scrollbars=yes,location=no,toolbar=no');
    if (window.focus) {newwindow.focus();}}</script>
	</div></form>
</body>
</html>