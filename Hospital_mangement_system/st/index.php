<?php  
include_once ('../lib/library.php');
if ($_SESSION['mtuid']==""){ 
 header ('Location: ../.');
    exit();} $pagename='.'; $pagegroup='st'; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
<title>User Administration</title>            
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
<style>
#dvLoading{background: url(../images/loading.gif) no-repeat center center;
   height: 50px; width: 100px; position: fixed; z-index: 1000; left: 50%; top: 30%; margin: -25px 0 0 -25px;
}</style>
<script>
$(document).ready(function(){
	$('#dvLoading').fadeOut(1000);
	$('#refresh').click(function(){
		windows: location = '../st/.';
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
<a id="b1" class="btn btn-primary" title="add new record." href="#"><i class='icon-white icon-plus'></i></a>
<button id="refresh" class="btn btn-primary" title="refresh form."><i class='icon-white icon-refresh'></i></button>
<button id="find" name="find" class="btn btn-primary" title="find record from database."><i class='icon-white icon-search'></i></button>
<input type="text" name="user" title="enter user name or login name to search" placeholder="Enter User Name" />
<br />

<!--//////////////////////////////// Add Dialog ///////////////////////////////////////////-->
    <div id="d1" title="Add User" style="display: block">
            <div class="control-group">
                    <label class="control-label">User Name :</label>
                <div class="controls">
                    <input required="required" title="Enter text only." type="text" name="uname" placeholder="User Name" id="uname"/>
                </div>
            </div>
            <div class="control-group">
                    <label class="control-label">Log-in :</label>
                <div class="controls">
                    <input required="required" title="Enter text only." type="text" name="lname" placeholder="Log-in Name" id="lname"/>
                </div>
            </div>
             <div class="control-group">
                    <label class="control-label">Password :</label>
                <div class="controls">
                    <input required="required" title="Enter numbers only." type="password" name="pwd" placeholder="Password" id="pwd"/>
                </div>
            </div>
            <div class="control-group">
                    <label class="control-label">User Profile :</label>
                <div class="controls">
                <select id="pid" name="selectpidname" >
                <?php
                $query = "SELECT * FROM s_profile where status like 'active'";
                        $result = mysql_query($query) or die(mysql_error());  
                            while($row=mysql_fetch_array($result)){                                                 
							   echo "<option value='".$row[0]."'>".$row[1]."</option>";
							} ?>
                </select>                 
                </div>
            </div>
    </div>
    
<!--//////////////////////////////////// Edit Dialog ///////////////////////////////////////-->
    <div id="edit_dialog" title="Update User Information">
        <div class="control-group">
                    <label class="control-label">User ID :</label>
                <div class="controls">
                    <input title="No permission to edit." type="text" name="id1" id="id1"/>
                </div>
            </div>
            <div class="control-group">
                    <label class="control-label">User Name :</label>
                <div class="controls">
                    <input required="required" title="Enter text only." type="text" class="uname1" name="uname1" id="uname1"/>
                </div>
            </div>
            <div class="control-group">
                    <label class="control-label">Log-in Name :</label>
                <div class="controls">
                    <input required="required" title="User email address as login name." type="text" class="lname1" name="lname1" id="lname1"/>
                </div>
            </div>
             <div class="control-group">
                    <label class="control-label">User Profile :</label>
                <div class="controls">
                <select id="pid1" name="pid1" class="pid1" >
                <?php
                $query = "SELECT * FROM s_profile where status like 'active'";
                        $result = mysql_query($query) or die(mysql_error());  
                            while($row=mysql_fetch_array($result)){                                                 
							   echo "<option value='".$row[0]."'>".$row[1]."</option>";
							} ?>
                </select>                   
                </div>
            </div>
            
    </div>

<!--//////////////////////////////////// Delete Dialog ///////////////////////////////////////-->

    <div id="delete_dialog" title="Delete User Information">
        <div class="control-group">
        <label class="control-label">Are you sure you want to delete this record?</label>
                <div class="controls">
                    <input type="hidden" name="id2" id="id2"/>
                    <input type="text" readonly="readonly" name="lb2"/>
                </div>
        </div>
            
    </div>
    
<!--/////////////////////password reset///////////////////////////////////-->
    <div id="reset_dialog" title="Reset Password">
<div class="control-group">
                    <label class="control-label">User ID :</label>
                <div class="controls">
                    <input title="No permission to edit." type="text" name="id3" id="id3"/>
                </div>
            </div>
            <div class="control-group">
                    <label class="control-label">User Name :</label>
                <div class="controls">
                    <input title="Enter text only." type="text" class="uname3" name="uname3" id="uname3"/>
                </div>
            </div>
            <div class="control-group">
                    <label class="control-label">Password :</label>
                <div class="controls">
                    <input title="Reset with: 123456" type="text" class="pwd3" name="pwd3" id="pwd3"/>
                </div>
            </div>
            
    </div>



<!--////////////////////////////////// Checking Fill Dialog ///////////////////////////////////-->

<div id="d2" title="User Administration..." style="display:none;">
	<p><font color="red">All fields are required...!</font></p>
</div>
<br />
<!--Loading Data From Database-->
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example"
style="font-family: monospace; font-size: medium; width: 950px;">
                            <thead id="banner" style="cursor: pointer;">
                                <tr style="cursor: pointer;">		
                                    <th style="text-align:center;">ID</th>
                <th>Username</th>
                <th style="text-align:center;">Log-in Name</th>
                <th style="text-align:center;">Profile</th>
                <th style="text-align:center;">Status</th>
                <th style="text-align:center; width: auto;">Action</th>                               
                                    </tr>                                    
                           </thead>
                            <tbody>
                              	<?php 
                               if (isset($_POST['find'])){
			$query=@mysql_query("SELECT a.userid,a.uname,a.logname,b.p_name,a.status FROM s_users a,s_profile b
    where a.p_id=b.p_id and a.uname like '%".$_POST['user']."%' OR
	a.p_id=b.p_id and a.logname like '%".$_POST['user']."%' and a.userid>0 order by a.uname") or die(mysql_error());   	
							   }else{                               
$query=@mysql_query("SELECT a.userid,a.uname,a.logname,b.p_name,a.status FROM s_users a,s_profile b
    where a.p_id=b.p_id and a.userid>0 order by a.uname") or die(mysql_error());  }
           
                            while($record=@mysql_fetch_array($query)){
							$id=$record[0]; ?>                                                           
				<tr class='user' id='<?php echo $record[0]; ?>'>
                <td style="text-align:center;"><?php echo $record[0] ?></td>
                <td class="uname"><?php echo $record[1] ?></td>
                <td style="text-align:center;" class="lname"><?php echo $record[2] ?></td> 
                <td style="text-align:center;" class="profil"><?php echo $record[3] ?></td>
                <td style="text-align:center;" class="active"><?php echo $record[4] ?></td>
                <td style='text-align:center; width: auto;'>
                <a class="edit btn btn-primary" title='edit user record...' href="#" ><i class='icon-white icon-pencil'></i></a>
                    &nbsp;|&nbsp;
                <a class="delete btn btn-primary" title='delete user record...' href='#'><i class='icon-white icon-trash'></i></a>
                    &nbsp;|&nbsp;
                <a class="reset btn btn-primary" title='reset user password...' href='#'><i class='icon-white icon-retweet'></i></a></td>
            </tr>
                         <?php  }  ?>
						 
                            </tbody>
                        </table></div>
</form>
<script type="text/javascript">	
function nw(url){var newwin;
	newwin = window.open(url,'','height=500,width=850,top=20,left=50,scrollbars=yes,location=no,toolbar=no');
    if (window.focus) {newwindow.focus();}}</script>

<!--</center></div>-->

</body>