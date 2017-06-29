<?php  
include_once ('../lib/library.php');
if ($_SESSION['mtuid']==""){ 
 header ('Location: ../.');
    exit();} $pagename='.'; $pagegroup='dr';	?>

<!DOCTYPE html>
<html lang="en">
    <head>
<title>Patient Ward Rooms</title>            
<link rel="icon" href="../images/flag.png" />
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
<style>
#dvLoading{background: url(../images/loading.gif) no-repeat center center;
   height: 50px; width: 100px; position: fixed; z-index: 1000; left: 50%; top: 30%; margin: -25px 0 0 -25px;
}</style>
<script>
$(document).ready(function(){
	$('#dvLoading').fadeOut(1000);
	
		$(function() {
		var tabs = $( "#tabs" ).tabs();
		tabs.find( ".ui-tabs-nav" ).sortable({
			axis: "x",
			stop: function() {
				tabs.tabs( "refresh" );
			}
		});
	});
	
});
</script>
<?php include_once ('../lib/popclose.php'); ?>
</head>
<body style="background: white;" onload="StartTimers();" onmousemove="ResetTimers();" onmousedown="disablecopy();" oncontextmenu="return false" oncopy="return false" onpaste="return false" oncut="return false">
<form name="" action="." method="post" >
<h2 id="banner"><div style="width: auto; float: left;"><img src="../images/mt.png" style="width: 10%; height: 8%;"/>
WELCOME to: <?php echo $_SESSION['app']; ?> </div>
	<div style="float: right; width: 15%;"><p>
	</p></div>														
 <br /> 
</h2>
<hr />
<div id="dvLoading"></div>
<div class="modal-header">
<button id="refresh" class="btn btn-primary" title="refresh form."><i class='icon-white icon-retweet'></i></button>
<button id="find" name="find" class="btn btn-primary" title="find record from database."><i class='icon-white icon-search'></i></button>
<input type="text" name="user" title="enter user name or login name to search" placeholder="Enter User Name" />
<br />
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Clinical Notes</a></li>
	</ul>
	<div id="tabs-1">
	
</div>
</div>
</form>
<script type="text/javascript">	
function nw(url){var newwin;
	newwin = window.open(url,'','height=500,width=850,top=20,left=50,scrollbars=yes,location=no,toolbar=no');
    if (window.focus) {newwindow.focus();}}</script>

<!--</center></div>-->

</body>