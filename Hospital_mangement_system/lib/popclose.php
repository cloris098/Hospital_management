<script>
var timoutWarning = 500000; // Display warning in 2.5 mins.
var timoutNow =   <?php echo $_SESSION['timeOut'] ?>; //600000; //|| Timeout: 1000ms is 1 secs.
var warningTimer;	var timeoutTimer;
function StartTimers() {warningTimer = setTimeout("IdleWarning()", timoutWarning);	timeoutTimer = setTimeout("IdleTimeout()", timoutNow);}
function ResetTimers() {clearTimeout(warningTimer);	clearTimeout(timeoutTimer);	StartTimers();}
function IdleTimeout() {self.close();}
</script>
<script language="javascript" type="text/javascript">
    //this code handles the F5/Ctrl+F5/Ctrl+R
    document.onkeydown = checkKeycode
    function checkKeycode(e) {
        var keycode;
        if (window.event)
            keycode = window.event.keyCode;
        else if (e)
            keycode = e.which;

        // Mozilla firefox
        if ($.browser.mozilla) {
            if (keycode == 116 ||(e.ctrlKey && keycode == 82)) {
                if (e.preventDefault)
                {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }
        } 
        // IE
        else if ($.browser.msie) {
            if (keycode == 116 || (window.event.ctrlKey && keycode == 82)) {
                window.event.returnValue = false;
                window.event.keyCode = 0;
                window.status = "Refresh is disabled";
            }
        }
    }
</script>
<?php 
//check if user has access to that menu file trying to open from browser url, redirect to login or close page
$check=mysql_query("select a.floc,b.m_id,c.sp_id from s_menu_groups a,s_menus b,sp_menus c where
	a.floc='".$pagegroup."' and a.mg_id=b.mg_id and b.m_url='".$pagename."' and c.sp_id='".$_SESSION['profid']."'
	and b.m_id=c.sm_id") or die(mysql_error());
	if (mysql_num_rows($check)<1){	//header ('Location: ../.'); exit();	
		echo '<div class="info" style="width: auto;"><i class="icon-eye-open icon-large"></i> Sorry, you do not have access to this page! You are being watched. Your continuous try will block your access to this system!</div>';	exit();	}


?>