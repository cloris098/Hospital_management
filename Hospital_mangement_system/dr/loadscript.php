<?php
include_once ('../lib/library.php');
 if (isset($_POST['refresh'])){ ?> <script>$('#vasplus_programming_blog_wrapper').slideUp('fast');</script> 
<?php goto dataRecords; exit();}
elseif (isset($_POST['find'])) { ?><script>$('#vasplus_programming_blog_wrapper').slideUp('fast');</script>
<div id="load_problem"><p id="msg" style="width: auto;"></p>
<?php  if (isset($_POST['pname']) && !empty($_POST['pname'])){ //load data when user posts problem by clicking find button
		if ($_POST['operand']=='Contains'){
$mydata = mysql_query("SELECT a.prob_id,a.problem,a.status,b.uname from pat_problem a,s_users b where a.inputter=b.logname
 and a.problem like '%".$_POST['pname']."%'  order by a.problem") or die(mysql_error());	
		}elseif ($_POST['operand']=='Starts With'){
$mydata = mysql_query("SELECT a.prob_id,a.problem,a.status,b.uname from pat_problem a,s_users b where a.inputter=b.logname
 and a.problem like '".$_POST['pname']."%' order by a.problem") or die(mysql_error());	
		}else {
$mydata = mysql_query("SELECT a.prob_id,a.problem,a.status,b.uname from pat_problem a,s_users b where a.inputter=b.logname
 and a.problem ".$_POST['pcrit']." '".$_POST['pname']."'order by a.problem") or die(mysql_error()); }
 ?>
 <div class="info" id="msg">Records for Problem that <?php  echo $_POST['operand'].': '. $_POST['pname']; ?></div> <br />
<?php }else { //load data when user click refresh to load all records
	dataRecords:
$mydata = mysql_query("SELECT a.prob_id,a.problem,a.status,b.uname from pat_problem a,s_users b 
 where a.inputter=b.logname order by a.problem") or die(mysql_error());}?> 
 <div id="reload_table">
<a id="add_pro" class="btn btn-primary" title="add new problem" href="#"><i class='icon-white icon-plus'></i></a>
<button id="refresh" name="refresh" type="submit" class="btn btn-primary" title="refresh form"><i class='icon-white icon-retweet'></i></button>
<!--<a id="refresh" class="btn btn-primary" title="refresh form" href="#"><i class='icon-white icon-retweet'></i></a>-->
<a id="ifind" class="btn btn-primary" title="find problem" href="#"><i class='icon-white icon-search'></i></a>
<br /><br />
 <div>Number of Records Found: <?php echo mysql_num_rows($mydata); ?> </div>
<br />
 <table style="width: 700px; cursor: pointer;" cellpadding="0" cellspacing="0" border="0" 
 class="table table-striped table-bordered" id="maintbl" style="font-family: monospace; font-size: large;">
		<thead style="background-color:beige;">
        <tr>	<th>ID:</th>
                <th>Problem:</th>
				<th style="text-align: center;">Status:</th>
				<th style="text-align: center;">Inputter:</th>
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
				<td class="status" style="text-align: center;"><?php echo $record[3] ?></td>
                <td style='text-align:center; width: auto;'>
                <a class="edit" title='edit <?php echo $record[1]; ?> profile menu...' href="#" ><i class='icon-pencil'></i></a>
                    &nbsp;|&nbsp;
                <a class="delete" title='delete <?php echo $record[1]; ?> profile menu...' href='#'><i class='icon-trash'></i></a>
				   
                
                </td>
            </tr>
            
<?php
       	 	}
?>  </tbody>
<!--End Loading Data From Database-->
		</table></div></div><?php  } ?>