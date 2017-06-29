//Data Updating
$(document).ready(function() {
	//Create dialog Edite  
   	$edit_data = $("#edit_data").dialog({  
    autoOpen:false, title:"Edit Data", modal:true,   
    buttons: { 
      "Update": function() { 
		var epro_id = $("#eproid").val(),epro_name=$("#eproname").val(),epro_cost=$.trim($('#eprocost').val()),
		epro_categ=$('#eprocateg').val();
		if(epro_id=='' || epro_name=='' || epro_cost==''){
			$("#d2").dialog("open");
				$("#d2").dialog({
					buttons:{
						"OK":function(){
								$(this).dialog("close");
								$("#eproname").focus();	
							}}	}); exit;}
		$('#dvLoading').fadeIn();
		$('#reload_table').slideUp('slow');	$('#toolbox').hide();			
		$.get('processUpdate.php?epro_id='+epro_id+'&epro_name='+epro_name+'&epro_cost='+epro_cost+'&epro_categ='+epro_categ, function(data){
			$('#pop').remove();	$('#msg').attr('class','info').text(data);
			$('#dvLoading').slideUp();$('#toolbox').show();	});
			$(this).dialog("close");
		}, "Cancel": function() { 
	  	$(this).dialog("close"); }  }});    
   function edit_link_action() {  
    var user = $(this).closest('.user');  
    var id = user.attr('id'); 
    $('#edit_data input[name="eproid"]').val(id); 
	$('#edit_data input[name="eproname"]').val($('.pro_name',user).text()); 
	$('#edit_data input[name="eprocost"]').val($('.pro_cost',user).text()); 
    $('#edit_data input[name="eprodate"]').val($('.pro_date',user).text());
	$('#edit_data select[name="eprocateg"]').val($('.categ_id',user).text()).attr('selected','selected'); 
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
		var dpro_id = $("#id2").val(),dpro_name=$('#lb2').val();
		if(dpro_id==''){
				alert("No record found in the database....!",title="Delete Data");
				exit;}//End if statement
		$.get('processDelete.php?dpro_id='+dpro_id+'&dpro_name='+dpro_name,function(data){
		$('#pop').remove();$('#reload_table').slideUp('slow');
		$('#msg').attr('class','info').text(data); 
		$('#load_products').load('../dr/pas #load_products').slideDown();	});//End Post
		$(this).dialog("close");	
		}, "Cancel": function() { 
	  	$(this).dialog("close"); }  }});    
   function delete_link_action() {  
    var user = $(this).closest('.user');  
    var id = user.attr('id'); 
    $('#delete_data input[name="id2"]').val(id);  
	$('#delete_data input[name="lb2"]').val($('.pro_name',user).text()); 
	$('#category').text('Are you sure you want to delete '+$('.pro_name',user).text()+' record?');
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
		var pro_name = $("#proname").val(),pro_cost=$.trim($('#procost').val()),pro_categ=$('#procateg').val();
		if (pro_name=='' || pro_cost=='' || pro_categ==''){
			$("#d2").dialog("open");
				$("#d2").dialog({
					buttons:{
						"OK":function(){
								$(this).dialog("close");
								$('#pro_name').focus();	
							}}	}); exit;		}
		//$.get('loadprob.php?receipt=' + $('#receipt').val(), function(data) { $("#mtable").last().append(data);});
		$('#toolbox').hide();	$('#dvLoading').fadeIn();$('#reload_table').slideUp('slow');
		$.get('processAdd.php?pro_name='+pro_name+'&pro_cost='+pro_cost+'&pro_categ='+pro_categ, function(data){
		$('#msg').attr('class','info').text(data);
		$('#pop').remove(); 
		$('#dvLoading').slideUp();$('#toolbox').show();	 });//End Post 
		$(this).dialog("close");
		$("#proname").val('');$("#procost").val('');		
		}, "Cancel": function() { 
	  	$("#proname").val(''); $('#procost').val('');
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

