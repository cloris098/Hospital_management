<?php 
require_once ('lib/library.php');
if (!isset($_SESSION['mtuid']) || $_SESSION['ulog']!=md5($_SESSION['mtuid'].$_SESSION['logdate'])){ 
 header ('Location: .');
    exit();} ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>User Home | MtZH</title>
<link href="images/lg.png" rel="icon" />
<script src="js/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script src="js/bootstrap.js" type="text/javascript"></script>
<script src="js/jquery.qtip.min.js"></script>
<link rel="stylesheet" href="css/bootstrap-responsive.css" type="text/css"/> 
<link rel="stylesheet" href="css/jquery.qtip.min.css" type="text/css"/>
  <link rel="stylesheet" href="lib/jquery.treeview.css" />	
	<script src="lib/jquery.js" type="text/javascript"></script>
	<script src="lib/jquery.cookie.js" type="text/javascript"></script>
	<script src="lib/jquery.treeview.js" type="text/javascript"></script>
	<link rel="stylesheet" href="lib/screen.css" />
	<script type="text/JavaScript">
			var timoutWarning = 840000; // Display warning in 14 Mins.
			var timoutNow =   <?php echo $_SESSION['maintimeOut'] ?>;
			var logoutUrl = '.'; // URL to logout page.
			var warningTimer;
			var timeoutTimer;
			function StartTimers() {
				warningTimer = setTimeout("IdleWarning()", timoutWarning);
				timeoutTimer = setTimeout("IdleTimeout()", timoutNow);}
			function ResetTimers() {
				clearTimeout(warningTimer);
				clearTimeout(timeoutTimer);
				StartTimers();
				$("#timeout").dialog('close');}
			function IdleTimeout() {window.location = logoutUrl;}
		</script>

	<script type="text/javascript">
	$(document).before(function(){
		$("#browser").treeview({
			toggle: function() {
				console.log("%s was toggled.", $(this).find(">span").text());
			}
		});
		
		$("#add").click(function() {
			var branches = $("<li><span class='folder'>New Sublist</span><ul>" + 
				"<li><span class='file'>Item1</span></li>" + 
				"<li><span class='file'>Item2</span></li></ul></li>").appendTo("#browser");
			$("#browser").treeview({
				add: branches
			});
		});
	});
	</script>
<style>
#dvLoading{  background: url(images/loading.gif) no-repeat center center;
   height: 50px;  width: 100px;  position: fixed;  z-index: 1000;  left: 50%;  top: 30%; margin: -25px 0 0 -25px;}</style>
</head>
<body bgcolor="#E0F2F7" onload="StartTimers();" onmousemove="ResetTimers();" onmousedown="disablecopy();" oncontextmenu="return false" oncopy="return false" onpaste="return false" oncut="return false" onkeydown="return (event.keyCode != 116)" >
<div id="dvLoading"></div>
<style> div { display:inline-block; }</style>
<form action="" method="post">
<h2 id="banner"><div style="width: auto; float: left;"><img src="images/mt.png" style="width: 10%; height: 8%;"/>
WELCOME to: <?php echo $_SESSION['app']; ?></div>
	<div style="float: right; width: auto;"><p>
	<ul><li class="dropdown"> 
<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
<i class="icon-white icon-user icon-large"></i> User: <?php echo $_SESSION['usname']; ?> <i class="caret"></i></a>
				<ul class="dropdown-menu" >
				<li>
				<a href="javascript:nw('pchge/.');" style="color: black;"><i class="icon-pencil"></i> Change Password</a>
				</li>
				<li class="divider"></li>
				<li><a href="." style="color: black;" style="text-align: left"><i class="icon-lock"></i> Sign Out</a></li>
															</ul></li>
															</ul></p></div>
															
 <br /> 
</h2>
<hr />
<!--<div id="dvLoading"></div>-->
<div id="main" style="width:1200px; height:500px; overflow: auto; overflow-x: auto;">
<ul id="browser" class="filetree treeview-famfamfam">			
<?php 
//selecting the loged in user menus...
$userid=$_SESSION['mtuid']; $h=0;$s=0;
$menuHead = @mysql_query("select spm.sp_id,smg.mg_name,smg.floc,smg.mg_id from sp_menus spm,s_menu_groups smg where
smg.mg_id=spm.smg_id and spm.sp_id='".$_SESSION['profid']."' and smg.active like 'y' group by smg.mg_id order by smg.mg_id") or die(mysql_error());
if (mysql_num_rows($menuHead)<1){
    echo "<div class='info' style='width:auto;'>Your profile has no menu assigned! Please contact your system administrator!</div><br/>" .mysql_error();
} else {
    while ($mheaders=@mysql_fetch_array($menuHead)){
        
?> <li class="closed"><span class="folder"><?php echo $mheaders[1]; ?></span>				
		<ul>
        	<?php  //select menu subitems...
	$menuSub=mysql_query("SELECT s_menus.m_name,s_menus.m_url FROM s_menus
  INNER JOIN sp_menus ON (s_menus.mg_id = sp_menus.smg_id) AND (s_menus.m_id = sp_menus.sm_id) and 
  sp_menus.sp_id='".$_SESSION['profid']."' and sp_menus.smg_id='".$mheaders[3]."' and s_menus.active like 'y'
   order by s_menus.m_id ") or die(mysql_error());
                    if (mysql_num_rows($menuSub)<1 || !$menuSub){
                 echo "<div class='info' style='width:auto;'>Your menus are not yet defined. Please contact your system administrator!</div>";
                        echo mysql_error();         
                    }else { while ($smenu=mysql_fetch_array($menuSub)){ ?>				
                   <li><span class="file">
  <a href="javascript:nw
  <?php echo str_replace($smenu[0]," ",""); ?>('<?php echo $mheaders[2]."/".$smenu[1]; ?>','<?php echo $smenu[0]; ?>');"><?php echo $smenu[0]; ?></a> 
 
                   </span></li>
				
  <?php } } ?>  </ul></li> <?php } ?>
  <script>
$(document).ready(function(){
  $('#dvLoading').fadeOut(1000);
});
</script>
  <?php } ?>              
 
</ul>
</div>	

<script type="text/javascript">	
function nw(url){
    var newwin;
	newwin = window.open(url,'','height=500,width=1000,top=20,left=50,scrollbars=yes,location=no,toolbar=no');
//  	newwin = window.open(url,'','height=auto,width=auto,top=20,left=50,scrollbars=yes,location=no,toolbar=no');
    if (window.focus) {newwindow.focus();}
    
}</script>
</form>

</body>
</html>