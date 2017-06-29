//Problem Updating
$(document).ready(function() {
	//Create dialog Edite  
   	$edit_problem = $("#edit_problem").dialog({  
    autoOpen:false, title:"Edit Problem", modal:true,   
    buttons: { 
      "Update": function() { 
		var pid = $("#pid").val(),pname=$("#pname1").val();
		if(pid=='' || pname==''){
			$("#d2").dialog("open");
				$("#d2").dialog({
					buttons:{
						"OK":function(){
								$(this).dialog("close");
								$("#pname1").focus();	
							}}	}); exit;}
			$('#reload_table').slideUp('slow');				
		$.post('processUpdate.php',{pid: pid, pname: pname, action:'probedit'} );
		$(this).dialog("close");$('#pop').remove();
		$('#msg').attr('class','info').text(pname+' record updated successfully...');
	//	$('#load_problem').fadeOut('slow').load('../pi/ptpr #load_problem').fadeIn("slow");
	//window.location.replace("../pi/ptpr.php");		
		}, "Cancel": function() { 
	  	$(this).dialog("close"); }  }});    
   function edit_link_action() {  
    var user = $(this).closest('.user');  
    var id = user.attr('id'); 
    $('#edit_problem input[name="pid"]').val(id); 
	$('#edit_problem input[name="pname1"]').val($('.pname',user).html()); 
    $edit_problem.dialog('open');    
    return false;  }    
   $(".edit").click(edit_link_action);  });


//Delete Problem Function
$(document).ready(function() {
	//Create dialog Edite  
   	$delete_problem = $("#delete_problem").dialog({  
    autoOpen:false, title:"Delete Problem", modal:true,   
    buttons: { 
      "Delete": function() { 
		var pid = $("#id2").val(),pname=$('#lb2').val();
		if(pid==''){
				alert("No record found in the database....!",title="Delete User Information");
				exit;}//End if statement
		$.post('processDelete.php',{
			pid: pid, action:'profiledelete'
		});//End Post
		$(this).dialog("close");$('#pop').remove();$('#reload_table').slideUp('slow');
		$('#msg').attr('class','info').text(pname+' record deleted successfully...');
	//window.location.replace("../pi/ptpr.php");		
		}, "Cancel": function() { 
	  	$(this).dialog("close"); }  }});    
   function delete_link_action() {  
    var user = $(this).closest('.user');  
    var id = user.attr('id'); 
    $('#delete_problem input[name="id2"]').val(id);  
	$('#delete_problem input[name="lb2"]').val($('.pname',user).html()); 
	$('#probname').text('Are you sure you want to delete '+$('.pname',user).html()+' record?');
    $delete_problem.dialog('open');    
    return false;  }   
   $(".delete").click(delete_link_action);  });
   
// Add New Profile Dialog Open
$(function () {	 
$("#add_problem").dialog({
    autoOpen: false,
    height: 'auto',
    width: 'auto',
    modal: true,
	closeOnEscape:true, 
	resizable:false, 
	show:'fade',
    buttons: { 
      "Save": function() { 
		var pname = $("#probl").val();
		if (pname==''){
			$("#d2").dialog("open");
				$("#d2").dialog({
				buttons:{
				"OK":function(){
					$(this).dialog("close");
					$('#pname').focus();	
				}}	}); exit;	}
		$.post('processAdd.php',{pname: pname, action: 'probadd'});//End Post 
		$("#pname").val('');$(this).dialog("close");$('#pop').remove();
		$('#reload_table').slideUp('slow');
		$('#msg').attr('class','info').text(pname+' record saved successfully...');
		//window.location.replace("../pi/ptpr.php");		
		}, "Cancel": function() { 
	  	$("#pname").val('');
	  	$(this).dialog("close"); 	}  }});
$("#add_pro").click(function(){
    $("#add_problem").dialog("open");});
$("#add_pros").click(function(){
    $("#add_problem").dialog("open");});

	});
	
//***********************************end of patient problem administration**********************************

//**********************************end of patient administration********************************************

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

