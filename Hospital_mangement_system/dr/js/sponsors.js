//Data Updating
$(document).ready(function() {
	//Create dialog Edite  
   	$edit_data = $("#edit_data").dialog({  
    autoOpen:false, title:"Edit Data", modal:true,   
    buttons: { 
      "Update": function() { 
		var spid = $("#espid").val(),recname=$("#espname").val(),spdetail=$('#espdetail').val();
		if(spid=='' || recname=='' || spdetail==''){
			$("#d2").dialog("open");
				$("#d2").dialog({
					buttons:{
						"OK":function(){
								$(this).dialog("close");
								$("#spname").focus();	
							}}	}); exit;}
			$('#reload_table').slideUp('slow');				
		$.post('processUpdate.php',{spid: spid, spname: recname, spdetail: spdetail} );
		$(this).dialog("close");$('#pop').remove();
		$('#msg').attr('class','info').text(recname+' record updated successfully...');		
		}, "Cancel": function() { 
	  	$(this).dialog("close"); }  }});    
   function edit_link_action() {  
    var user = $(this).closest('.user');  
    var id = user.attr('id'); 
    $('#edit_data input[name="espid"]').val(id); 
	$('#edit_data input[name="espname"]').val($('.spname',user).text()); 
    $('#edit_data input[name="espdetail"]').val($('.spdetail',user).text());
	$('#edit_data input[name="espinputter"]').val($('.spinputter',user).text());
	$edit_data.dialog('open');    
    return false;  }    
   $(".edit").click(edit_link_action);  });


//Delete data Function
$(document).ready(function() {
	//Create dialog Edite  
   	$delete_data = $("#delete_data").dialog({  
    autoOpen:false, title:"Delete Data", modal:true,   
    buttons: { 
      "Delete": function() { 
		var spid = $("#id2").val(),recname=$('#lb2').val();
		if(spid==''){
				alert("No record found in the database....!",title="Delete Data");
				exit;}//End if statement
		$.post('processDelete.php',{spid: spid});//End Post
		$(this).dialog("close");$('#pop').remove();$('#reload_table').slideUp('slow');
		$('#msg').attr('class','info').text(recname+' record deleted successfully...');		
		}, "Cancel": function() { 
	  	$(this).dialog("close"); }  }});    
   function delete_link_action() {  
    var user = $(this).closest('.user');  
    var id = user.attr('id'); 
    $('#delete_data input[name="id2"]').val(id);  
	$('#delete_data input[name="lb2"]').val($('.spname',user).html()); 
	$('#dspname').text('Are you sure you want to delete '+$('.spname',user).html()+' record?');
    $delete_data.dialog('open');    
    return false;  }   
   $(".delete").click(delete_link_action);  });
   
// Add New Profile Dialog Open
$(function () {	 
$("#add_data").dialog({
    autoOpen: false,
    height: 'auto',
    width: 'auto',
    modal: true,
	closeOnEscape:true, 
	resizable:false, 
	show:'fade',
    buttons: { 
      "Save": function() { 
		var spname = $("#aspname").val(),spdetail=$('#aspdetail').val(),aspinput=$('#aspinput').val();
		if (spname=='' || spdetail=='' || aspinput==''){
			$("#d2").dialog("open");
				$("#d2").dialog({
					buttons:{
						"OK":function(){
								$(this).dialog("close");
								$('#aspname').focus();	
							}}	}); exit;		}
		$.post('processAdd.php',{spname: spname, spdetail: spdetail});//End Post 
		$("#spname").val('');$("#spdetail").val('');$("#spdate").val('');$("#spinputter").val('');
		$(this).dialog("close");$('#pop').remove();$('#reload_table').slideUp('slow');
		$('#msg').attr('class','info').text(spname+' record saved successfully...');		
		}, "Cancel": function() { 
	  	$("#spname").val('');$("#spdetail").val('');$("#spdate").val('');$("#spinputter").val('');
	  	$(this).dialog("close"); 	}  }});
$("#add_pro").click(function(){
    $("#add_data").dialog("open");});
$("#add_pros").click(function(){
    $("#add_data").dialog("open");});
	});
	
//***********************************end of patient problem administration**********************************


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

