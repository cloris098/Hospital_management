<?php
include_once ('../lib/library.php');
if (isset($_GET['receipt'])){ //save booked patients record for attendance
 $mydata=mysql_query("select a.prob_id,a.problem,b.prob_dur,b.attend_id from problem_type a,patient_problems b
 	where a.prob_id=b.prob_id and b.attend_id='".$_GET['receipt']."'") or die(mysql_error());
	$i=0;while ($problem=mysql_fetch_array($mydata)){$i=$i+1;
		echo '<tr><td style="font-weight: bold;">Problem '.$i.'</td>
		<td><input type="hidden" readonly="readonly" name="problems[]" id="problems" value="'.$problem[0].'" />
		<input type="text" readonly="readonly" name="problem" id="problem" value="'.$problem[1].'" /> 
	<input type="text" readonly="readonly" name="durations[]" style="width: 110px;" id="durations" value="'.$problem[2].'" /> 
	<a id="minus_this" href="#" class="minus_this btn btn-primary" title="remove problem"><i class="icon-white icon-minus"></i></a></td></tr>';	
		}
 }
 ?> 