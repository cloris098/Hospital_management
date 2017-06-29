//Data Updating
$(document).ready(function() {
	//Create dialog Edite  
   	$edit_data = $("#edit_data").dialog({  
    autoOpen:false, title:"Edit Data", modal:true,   
    buttons: { 
      "Update": function() { 
		var ecateg_id = $("#ecateg_id").val(),ecateg_name=$("#ecateg_name").val();
		if(ecateg_id=='' || ecateg_name==''){
			$("#d2").dialog("open");
				$("#d2").dialog({
					buttons:{
						"OK":function(){
								$(this).dialog("close");
								$("#ecateg_name").focus();	
							}}	}); exit;}
			$('#reload_table').slideUp('slow');				
		$.post('processUpdate.php',{ecateg_id: ecateg_id, ecateg_name: ecateg_name} );
		$(this).dialog("close");$('#pop').remove();
		$('#msg').attr('class','info').text(ecateg_name+' record updated successfully...');		
		}, "Cancel": function() { 
	  	$(this).dialog("close"); }  }});    
   function edit_link_action() {  
    var user = $(this).closest('.user');  
    var id = user.attr('id'); 
    $('#edit_data input[name="ecateg_id"]').val(id); 
	$('#edit_data input[name="ecateg_name"]').val($('.categ_name',user).text()); 
    $('#edit_data input[name="ecateg_date"]').val($('.categ_date',user).text());
	$('#edit_data input[name="inputter"]').val($('.inputter',user).text());
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
		var dcateg_id = $("#id2").val(),dcateg_name=$('#lb2').val();
		if(dcateg_id==''){
				alert("No record found in the database....!",title="Delete Data");
				exit;}//End if statement
		$.post('processDelete.php',{dcateg_id: dcateg_id});//End Post
		$(this).dialog("close");$('#pop').remove();$('#reload_table').slideUp('slow');
		$('#msg').attr('class','info').text(dcateg_name+' record deleted successfully...');		
		}, "Cancel": function() { 
	  	$(this).dialog("close"); }  }});    
   function delete_link_action() {  
    var user = $(this).closest('.user');  
    var id = user.attr('id'); 
    $('#delete_data input[name="id2"]').val(id);  
	$('#delete_data input[name="lb2"]').val($('.categ_name',user).text()); 
	$('#category').text('Are you sure you want to delete '+$('.categ_name',user).text()+' record?');
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
		var categ_name = $("#categ_name").val();
		if (categ_name==''){
			$("#d2").dialog("open");
				$("#d2").dialog({
					buttons:{
						"OK":function(){
								$(this).dialog("close");
								$('#categ_name').focus();	
							}}	}); exit;		}
		$.post('processAdd.php',{categ_name: categ_name});//End Post 
		$("#categ_name").val('');
		$(this).dialog("close");$('#pop').remove();$('#reload_table').slideUp('slow');
		$('#msg').attr('class','info').text(categ_name+' record saved successfully...');		
		}, "Cancel": function() { 
	  	$("#categ_name").val('');
	  	$(this).dialog("close"); 	}  }});
$("#add_data_btn").click(function(){
	$("#add_data").dialog("open");});
	});
	
//***********************************end of product and service administration**********************************


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

