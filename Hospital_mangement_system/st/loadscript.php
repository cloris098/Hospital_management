<?php
include_once ('../lib/library.php');
if ($_SESSION['mtuid']=="" ){ 
 header ('Location: ../.');
    exit();}
$query=mysql_query("SELECT a.m_id,a.m_name FROM s_menus a where a.mg_id='".$_GET['menu']."' order by m_name");
	while($rows=mysql_fetch_array($query)){
$find=mysql_query("SELECT b.m_name from s_menus b,sp_menus c,s_profile d where b.m_id=c.sm_id and c.sm_id='".$rows[0]."' and c.sp_id=d.p_id and d.p_name='".$_SESSION['proname']."' and b.mg_id='".$_GET['menu']."' order by b.m_name");
	if (mysql_num_rows($find)>=1){ //the profile selected menu has been assigned to that profile
  	while($resm=mysql_fetch_array($find)){
echo  "<tr><td><input type='text' readonly='readonly' value='$resm[0]' /></td><td style='text-align:center;'><input type='hidden' value='$rows[0]' id='lmenus[]' name='lmenus[]' /><input type='hidden' name='gid[]' id='gid[]' value='".$_GET['menu']."' /><input type='text' id='lmenu' name='lmenu' readonly='readonly' value='$rows[1]' /> <a class='remove_menu btn btn-primary' href='#' title='remove $rows[1] menu access...'><i class='icon-white icon-minus'></i></a></td></tr>";}
	}else {
 echo  "<tr><td><input type='text' readonly='readonly' /></td><td style='text-align:center;'><input type='hidden' id='lmenus[]' name='lmenus[]' value='$rows[0]' /><input type='hidden' name='gid[]' id='gid[]' value='".$_GET['menu']."' /><input type='text' id='lmenu' name='lmenu' readonly='readonly' value='$rows[1]' /> <a class='remove_menu btn btn-primary' href='#' title='remove $rows[1] menu access...'><i class='icon-white icon-minus'></i></a></td></tr>";}
			}?>