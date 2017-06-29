//Delete data Function
$(document).ready(function() {
	//Create dialog Edite  
   	$delete_patient = $("#delete_patient").dialog({  
    autoOpen:false, title:"Delete Data", modal:true,   
    buttons: { 
      "Delete": function() { 
		var pid = $("#id2").val(),pname=$('#lb2').val();
		if(pid==''){
				alert("No record found in the database....!",title="Delete Data");
				exit;}//End if statement
			$('<div id="dvLoading"></div>');
		$.post('processDelete.php',{patid: pid, action: 'patdelete'});//End Post
		$(this).dialog("close");$('#pop').remove();$('#reload_table').slideUp('slow');
		$('#msg').attr('class','info').text(pname+' record deleted successfully...');
		}, "Cancel": function() { 
	  	$(this).dialog("close"); }  }});    
   function delete_link_action() {  
    var user = $(this).closest('.user');  
    var id = user.attr('id'); 
    $('#delete_patient input[name="id2"]').val($('.p_id',user).text());  
	$('#delete_patient input[name="lb2"]').val($('.pfname',user).text()+' '+$('.psurname',user).text()); 
	$('#pname').text('Are you sure you want to delete '+$('.ptitle',user).text()+' '+$('.pfname',user).text()+' '+$('.psurname',user).text()+' record?');
    $delete_patient.dialog('open');    
    return false;  }   
   $(".delete_patient").click(delete_link_action);  });
//**********************************end of patient administration********************************************

$(document).ready(function() {
	//Create dialog delete  
   	$delete_register = $("#delete_register").dialog({  
    autoOpen:false, title:"Delete Data", modal:true,   
    buttons: { 
      "Delete": function() { 
		var rid = $("#id2").val(),rname=$('#lb2').val();
		if(rid==''){
				alert("No record found in the database....!",title="Delete Data");
				exit;}//End if statement
			$('<div id="dvLoading"></div>');
		$.post('processDelete.php',{regid: rid, action: 'registerdelete'});//End Post
		$(this).dialog("close");$('#pop').remove();$('#reload_table').slideUp('slow');
		$('#msg').attr('class','info').text(rname+' receipt #: '+rid+' deleted successfully from register...');
		}, "Cancel": function() { 
	  	$(this).dialog("close"); }  }});  
		  
   function register_link_action() {  
  
    var user = $(this).closest('.user');   var id = user.attr('id');  
	$('#delete_register input[name="id2"]').val($.trim($('.regid',user).text())); 
	$('#delete_register input[name="lb2"]').val($('.pfname',user).text()+' '+$('.psurname',user).text()); 
	$('#pname').text('Are you sure you want to delete '+$('.ptitle',user).text()+' '+$('.pfname',user).text()+' '+$('.psurname',user).text()+' from register?');
    $delete_register.dialog('open');    
    return false;  }   
   $(".delete").click(register_link_action);  });
   //*******************************************************end of patient register attendance**************************

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

