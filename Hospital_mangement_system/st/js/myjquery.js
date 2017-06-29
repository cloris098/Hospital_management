//Profile Updating
$(document).ready(function() {
	//Create dialog Edite  
   	$edit_profile = $("#edit_profile").dialog({  
    autoOpen:false, title:"Edit Profile", modal:true,   
    buttons: { 
      "Update": function() { 
		var pid = $("#pid").val(),pname=$("#pname1").val(),logtime= $('#timeouts').val();
		if(pid=='' || pname=='' || logtime==''){
			$("#d2").dialog("open");
				$("#d2").dialog({
					buttons:{
						"OK":function(){
								$(this).dialog("close");
								$("#pname1").focus();	
							}}	}); exit;}
		$.post('processUpdate.php',{pid: pid, pname: pname, timeouts: logtime, action:'profileedit'});
		$(this).dialog("close");
	window.location.replace("../st/adms");		
		}, "Cancel": function() { 
	  	$(this).dialog("close"); }  }});  
   //when the delete link is clicked  
   function edit_link_action() {  
    //get closest book div  
    var user = $(this).closest('.user');  
    //get id from div  
    var id = user.attr('id'); 
    //set id in form  
    $('#edit_profile input[name="pid"]').val(id); 
    //set current username in form 
	$('#edit_profile input[name="pname1"]').val($('.pname',user).text());
	$('#edit_profile input[name="timeouts"]').val($('.logout',user).text()); 
    //open dialog  
    $edit_profile.dialog('open');  
    //stop default link action  
    return false;  }   
   //attach action to edit links  
   $(".edit").click(edit_link_action);  });


//Delete Profile Function
$(document).ready(function() {
	//Create dialog Edite  
   	$delete_profile = $("#delete_profile").dialog({  
    autoOpen:false, title:"Delete Profile", modal:true,   
    buttons: { 
      "Delete": function() { 
		var pid = $("#id2").val();
		if(pid==''){
				alert("No record found in the database....!",title="Delete User Information");
				exit;}//End if statement
		$.post('processDelete.php',{
			pid: pid, action:'profiledelete'
		});//End Post
		$(this).dialog("close");
	window.location.replace("../st/adms");		
		}, "Cancel": function() { 
	  	$(this).dialog("close"); }  }});  
   //when the delete link is clicked  
   function delete_link_action() {  
    //get closest book div  
    var user = $(this).closest('.user');  
    //get id from div  
    var id = user.attr('id'); 
    //set id in form  
    $('#delete_profile input[name="id2"]').val(id); 
    //set current username in form 
	$('#delete_profile input[name="lb2"]').val($('.pname',user).text()); 
    //open dialog  
    $delete_profile.dialog('open');  
    //stop default link action  
    return false;  }   
   //attach action to edit links  
   $(".delete").click(delete_link_action);  });
   
// Add New Profile Dialog Open
$(function () {	
//	$(".sub").click(function(){
//	var id=$("#hidid").val();
//	alert(id);
//	})
// Add New Dialog Open	 
$("#add_profile").dialog({
    autoOpen: false,
    height: 'auto',
    width: 'auto',
    modal: true,
	closeOnEscape:true, 
	resizable:false, 
	show:'fade',
    buttons: { 
      "Save": function() { 
		var pname = $("#pname").val(),timeout=$('#timeout').val();
		if (pname==''){
			$("#d2").dialog("open");
				$("#d2").dialog({
					buttons:{
						"OK":function(){
								$(this).dialog("close");
								$('#pname').focus();	
							}}	}); exit;		}
		//$(this).after('<div id="loader"><img src="../images/loading.gif" alt="loading processing..." /></div>');
		$.post('processAdd.php',{
			pname: pname, timeout: timeout, action: 'profileadd'});//End Post 
		$("#pname").val('');				
		$(this).dialog("close");
		window.location.replace("../st/adms");		
		}, "Cancel": function() { 
	  	$("#pname").val('');
	  	$(this).dialog("close"); 	}  }});
$("#add_pro").click(function(){
    $("#add_profile").dialog("open");});
	});
	
//***********************************end of profile & user menu administration**********************************

//Delete User Function
$(document).ready(function() {
	//Create dialog Edite  
   	$delete_dialog = $("#delete_dialog").dialog({  
    autoOpen:false,   
    title:"Delete User Information",   
    modal:true,   
    buttons: { 
      "Delete": function() { 
		var id = $("#id2").val();
		if(id==''){
				alert("No record found in the database....!",title="Delete User Information");
				exit;
			}//End if statement
		$.post('processDelete.php',{
			user_id: id, action:'joined'
		});//End Post
		$(this).dialog("close");
	window.location.replace("../st/.");		
		},
      "Cancel": function() { 
	  	$(this).dialog("close"); 
		} 
    }
   });  
     
   //when the delete link is clicked  
   function delete_link_action() {  
    //get closest book div  
    var user = $(this).closest('.user');  
    //get id from div  
    var id = user.attr('id'); 
    //set id in form  
    $('#delete_dialog input[name="id2"]').val(id); 
    //set current username in form 
	$('#delete_dialog input[name="lb2"]').val($('.uname',user).text()); 
    //open dialog  
    $delete_dialog.dialog('open');     
    //stop default link action  
    return false;  }     
   //attach action to edit links  
   $(".delete").click(delete_link_action);  
  }); 
 
  
 ////////////////////////// Reset password function /////////////
$(document).ready(function() {
	//Create dialog reset password 
   	$reset_dialog = $("#reset_dialog").dialog({  
    autoOpen:false,   
    title:"Reset Password",   
    modal:true,   
    buttons: { 
      "Update Password": function() { 	  	
		var id = $("#id3").val(),
		runame = $('#uname3').val(),
		pwds = $('#pwd3').val();
		if(pwds==''){
				//alert("Please do not empty....!",title="Hello");
				$("#d2").dialog("open");
				$("#d2").dialog({
					buttons:{
						"OK":function(){
								$(this).dialog("close");
								$("#pwd3:first").focus();	
							}
						}
					}); 
				exit;
			}//End if statement
			
		$.post('processReset.php',{
			user_id: id, pwd: pwds, action:'joined'
		} );//End Post
		$(this).dialog("close");
		window.location.replace("../st/.");		
		},
      "Cancel": function() { 
	  	$("#id3").val('');
		$("#uname3").val('');
	  	$(this).dialog("close"); 
		} 
    }
   });  
     
   //when the reset link is clicked  
   function reset_link_action() {  
    //get closest book div  
    var user = $(this).closest('.user');  
      
    //get id from div  
    var id = user.attr('id'); 
	
    //set id in form  
    $('#reset_dialog input[name="id3"]').val(id).attr('disabled','disabled');  
      
    //set current username in form 
	$('#reset_dialog input[name="uname3"]').val($('.uname',user).text()).attr('disabled','disabled');     
        
    //open dialog  
    $reset_dialog.dialog('open');  
      
    //stop default link action  
    return false;  
   }  
     
   //attach action to edit links  
   $(".reset").click(reset_link_action);  
  });
   
////////////////////////// Update Function ///////////////////////////////////

$(document).ready(function() {
	//Create dialog Edite  
   	$edit_dialog = $("#edit_dialog").dialog({  
    autoOpen:false,   
    title:"Edit User Information",   
    modal:true,   
    buttons: { 
      "Update": function() { 
		var user_id = $("#id1").val(),
		user_name = $('#uname1').val(),
		log_name = $('#lname1').val();
        p_name=$('#pid1').val();
		if(user_name=='' || log_name=='' || p_name==''){
				//alert("Please do not empty....!",title="Hello");
				$("#d2").dialog("open");
				$("#d2").dialog({
					buttons:{
						"OK":function(){
								$(this).dialog("close");
								$("#id:first").focus();	
							}}	}); 
				exit;}//End if statement	
		$.post('processUpdate.php',{
			user_id: user_id, user_name: user_name, log_name: log_name, p_name: p_name
		});//End Post
		$(this).dialog("close");
		window.location.replace("../st/.");},
      "Cancel": function() { 
	  	$("#id").val('');
	  	$(this).dialog("close"); 
		} 
    }
   });  
     
   //when the edit link is clicked  
   function edit_link_action() {  
    //get closest book div  
    var user = $(this).closest('.user');  
      
    //get id from div  
    var id = user.attr('id'); 
	
    //set id in form  
    $('#edit_dialog input[name="id1"]').val(id).attr('disabled','disabled');  
      
    //set current username in form 
	$('#edit_dialog input[name="uname1"]').val($('.uname',user).text());  
    
	//set current logname in form
	$('#edit_dialog input[name="lname1"]').val($('.lname',user).text());
        
    //set current profile in form
	$('#edit_dialog select[name="pid1"]').val($('.profil',user).text());    
        
    //open dialog  
    $edit_dialog.dialog('open');  
      
    //stop default link action  
    return false;  
   }  
     
   //attach action to edit links  
   $(".edit").click(edit_link_action);  
  });
   
  
// Add Function   

$(function () {
	
	$(".sub").click(function(){
	var id=$("#hidid").val();
	alert(id);
	})
	
	
// Add New Dialog Open	 
$("#d1").dialog({
    autoOpen: false,
    height: 'auto',
    width: 'auto',
    modal: true,
	closeOnEscape:true, 
	resizable:false, 
	show:'fade',
    buttons: { 
      "Save": function() { 
	  	
		var uname = $("#uname").val(),
		logname = $('#lname').val(),
        passwd = $('#pwd').val(),
		p_id = $('#pid').val();
		if(uname=='' || logname=='' || passwd=='' || p_id=='')
			{
				//alert("Please do not empty....!",title="Hello");
				$("#d2").dialog("open");
				$("#d2").dialog({
					buttons:{
						"OK":function(){
								$(this).dialog("close");
								$("#uname:first").focus();	
							}
						}
					}); 
				exit;
			}//End if statement
			
		$.post('processAdd.php',{
			uname: uname, logname: logname, passwd: passwd, p_id: p_id, action:'joined'
		});//End Post   
        
		$("#uname").val('');
		$("#lname").val('');
		$("#pwd").val(''); $("#pid").val('');				
		$(this).dialog("close");
		window.location.replace("../st/.");		
		},
      "Cancel": function() { 
	  	$("#uname").val('');
		$("#lname").val(''); $("#pwd").val('');
		$("#pid").val('');
	  	$(this).dialog("close"); 
		} 
    }
});


$("#d2").dialog({
    autoOpen: false,
    height: 'auto',
    width: 'auto',
    modal: true,
	closeOnEscape:true, 
	resizable:false, 
	show:'fade',
    buttons: { 
      "Ok": function() { $(this).dialog("close"); } 
    }
});

$("#b1").click(function(){
    $("#d1").dialog("open");
});

});

////////////// Making Tooltip /////////////////////////
$(function() {
    $('a[title]').qtip({
         show: {
             delay: 1
         },
         hide: {
             delay: 0
         }
     });
	 $('button').qtip({
         show: {
             delay: 1
         },
         hide: {
             delay: 0
         }
     });
	 $('input[title]').qtip({
         show: {
             delay: 1
         },
         hide: {
             delay: 0
         }
     });
  });

