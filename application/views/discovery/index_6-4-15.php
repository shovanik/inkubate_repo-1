 <?=$this->load->view('template/inner_header_discover.php')?>
  <?php $usd = $this->session->userdata('logged_user'); ?>

<script type="text/javascript" src="<?=base_url()?>js/jquery-ui.min.js"></script>  
<script type="text/javascript" src="<?=base_url()?>js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.hoverIntent.minified.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.naviDropDown.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.blockUI.js"></script>
<script type="text/javascript">
$(function(){
	
	/*$('#navigation_horiz').naviDropDown({
		dropDownWidth: '300px',
        slideDownDuration: 500, 
        slideUpDuration: 500
	});
	
	$('#navigation_vert').naviDropDown({
		//dropDownWidth: '300px',
		orientation: 'vertical',
        slideDownDuration: 500, 
        slideUpDuration: 500
	});*/
});
$(document).ready(function() {
	//Tooltips
	$(".tip_trigger").hover(function(){
		tip = $(this).find('.tip');
		tip.show(); //Show tooltip
	}, function() {
		tip.hide(); //Hide tooltip		  
	}).mousemove(function(e) {
		var mousex = e.pageX + 20; //Get X coodrinates
		var mousey = e.pageY + 20; //Get Y coordinates
		var tipWidth = tip.width(); //Find width of tooltip
		var tipHeight = tip.height(); //Find height of tooltip
		
		//Distance of element from the right edge of viewport
		var tipVisX = $(window).width() - (mousex + tipWidth);
		//Distance of element from the bottom of viewport
		var tipVisY = $(window).height() - (mousey + tipHeight);
		  
		if ( tipVisX < 20 ) { //If tooltip exceeds the X coordinate of viewport
			mousex = e.pageX - tipWidth - 20;
		} if ( tipVisY < 20 ) { //If tooltip exceeds the Y coordinate of viewport
			mousey = e.pageY - tipHeight - 20;
		} 
		tip.css({  top: mousey, left: mousex });
	});
    
    
    
  $(".tip_trigger1").hover(function(){
		tip1 = $(this).find('.tip1');
		tip1.show(); //Show tooltip
	}, function() {
		tip1.hide(); //Hide tooltip		  
	}).mousemove(function(e) {
		var mousex = e.pageX + 20; //Get X coodrinates
		var mousey = e.pageY + 20; //Get Y coordinates
		var tipWidth = tip1.width(); //Find width of tooltip
		var tipHeight = tip1.height(); //Find height of tooltip
		
		//Distance of element from the right edge of viewport
		var tipVisX = $(window).width() - (mousex + tipWidth);
		//Distance of element from the bottom of viewport
		var tipVisY = $(window).height() - (mousey + tipHeight);
		  
		if ( tipVisX < 20 ) { //If tooltip exceeds the X coordinate of viewport
			mousex = e.pageX - tipWidth - 20;
		} if ( tipVisY < 20 ) { //If tooltip exceeds the Y coordinate of viewport
			mousey = e.pageY - tipHeight - 20;
		} 
		tip1.css({  top: mousey, left: mousex });
	});
 
    
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $("#content").find("[id^='tab']").hide(); // Hide all content
    $("#tabs li:first").attr("id","current"); // Activate the first tab
    $("#content #tab1").fadeIn(); // Show first tab's content
    
    $('#tabs a').click(function(e) {
        e.preventDefault();
        if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
         return;       
        }
        else{             
          $("#content").find("[id^='tab']").hide(); // Hide all content
          $("#tabs li").attr("id",""); //Reset id's
          $(this).parent().attr("id","current"); // Activate this
          $('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
        }
    });
    $('#cancl_pit').click(function () {
                       
                            $(".pit_work_dialog_vw").dialog('close');
                           
                        
             		});
   $(".pit_work_dialog_vw").dialog({
			close: function () {
			    
			}
		    });
  $('#cancl_pit').click()
});
</script>

<script type="text/javascript">
$(document).ready(function () {
    $('#chkBoxHelp').click(function () {
        if ($(this).is(':checked')) {
            $(".txtAge").dialog({
                close: function () {
                    $('#chkBoxHelp').prop('checked', false);
                }
            });
        } else {
            $(".txtAge").dialog('X');
        }
    });
});
</script>
<style>
 .pitchits_section_new3 #tabs a:hover:after, .pitchits_section_new3 #tabs a:focus, .pitchits_section_new3 #tabs a:focus:after {background-color: #6BC6FF  !important;}
.blue_select{
	background-color:#6BC6FF !important;
}
.li_pad { font-size: 13px;
    font-weight: bold;
    padding: 0 15px !important;
    text-transform: uppercase;
}
.li_sml {font-size: 12px;
    font-weight: normal;
text-transform: capitalize;
 padding: 0 15px !important;
}
#facebox .content { max-height: 110px; }

 #facebox .content input[type="button"] {float: right; background: #8dc63f; border: none; color:#fff; margin:15px 0 0 0; }
.ShowTheFilters {color:#16b4ef;}

#pit_work_dialog { width:750px !important;}


.pitchits_section_new3 .pitchits_section_right tbody td img { float: none; }
</style>
<script>
format = 0;
types = 0;
genre = 0;
multiple = 0;
arr_format = new Array();
arr_types = new Array();
arr_genre = new Array();
function saveFormat(id,type)
{
	/*types = 0;
	genre = 0;
	multiple = 0;*/
	if(format == 1)
	{
		$("."+type+"_"+id).addClass("blue_select");
		$(".types").removeClass("blue_select");
		$(".genre").removeClass("blue_select");
		$(".multiple").removeClass("blue_select");
		var index = arr_format.map(function(el) {
			  return el;
		}).indexOf(id);
		if(index > -1)
		{
			$(".format_"+id).removeClass("blue_select");
			arr_format.splice(index, 1);
		}
		else
		{
			arr_format.push(id);
		}
		//console.log(arr_format);
	}
	
}
function saveType(id,type)
{
	
	if(types == 1)
	{
		$("."+type+"_"+id).addClass("blue_select");
		$(".format").removeClass("blue_select");
		$(".genre").removeClass("blue_select");
		$(".multiple").removeClass("blue_select");
		
		var index = arr_types.map(function(el) {
			  return el;
		}).indexOf(id);
		if(index > -1)
		{
			$(".types_"+id).removeClass("blue_select");
			arr_types.splice(index, 1);
		}
		else
		{
			arr_types.push(id);
		}
		//console.log(arr_types);
	}
	
}
function saveGenre(id,type)
{
	if(genre == 1)
	{
		$("."+type+"_"+id).addClass("blue_select");
		$(".format").removeClass("blue_select");
		$(".types").removeClass("blue_select");
		$(".multiple").removeClass("blue_select");
		var index = arr_genre.map(function(el) {
			  return el;
		}).indexOf(id);
		if(index > -1)
		{
			$(".genre_"+id).removeClass("blue_select");
			arr_genre.splice(index, 1);
		}
		else
		{
			arr_genre.push(id);
		}
		//console.log(arr_genre);
		
	}
	
}
function saveMultiple(id,type,subtype)
{
	if(multiple == 1)
	{
		$("."+type+"_"+subtype+"_"+id).addClass("blue_select");
		$(".format").removeClass("blue_select");
		$(".genre").removeClass("blue_select");
		$(".types").removeClass("blue_select");
		if(subtype == "format")
		{
			var index = arr_format.map(function(el) {
				  return el;
			}).indexOf(id);
			if(index > -1)
			{
				$(".multiple_format_"+id).removeClass("blue_select");
				arr_format.splice(index, 1);
			}
			else
			{
				arr_format.push(id);
			}
			//console.log(arr_format);
		}
		if(subtype == "types")
		{
			var index = arr_types.map(function(el) {
			  	return el;
			}).indexOf(id);
			if(index > -1)
			{
				$(".multiple_types_"+id).removeClass("blue_select");
				arr_types.splice(index, 1);
			}
			else
			{
				arr_types.push(id);
			}
			//console.log(arr_types);
			
		}
		if(subtype == "genre")
		{
			var index = arr_genre.map(function(el) {
			  return el;
			}).indexOf(id);
			if(index > -1)
			{
				$(".multiple_genre_"+id).removeClass("blue_select");
				arr_genre.splice(index, 1);
			}
			else
			{
				arr_genre.push(id);
			}
			//console.log(arr_genre);
			
		}
	}
	
}
var base_url = '<?php echo base_url()?>';
function selectMultiple(type)
{
	types = 0;
	genre = 0;
	multiple = 0;
	format = 0;
	$("#dropdown_two").hide();
	$("#dropdown_four").hide();
	$("#dropdown_five").hide();
	$("#dropdown_six").hide();
	arr_format = new Array();
	arr_types = new Array();
	arr_genre = new Array();
	$("#subtype").val("");
	$("#searchCriteria").val("");
	$("#replace_down_two").attr("src", base_url+'images/arrow_down.png');
	$("#replace_down_four").attr("src", base_url+'images/arrow_down.png');
	$("#replace_down_five").attr("src", base_url+'images/arrow_down.png');
	$("#replace_down_six").attr("src", base_url+'images/arrow_down.png');
	
	if(type == "format")
	{
		
		format = 1;
		$("#dropdown_two").show();
		$("#replace_down_two").attr("src", base_url+'images/arrow_up.png');
	}
	if(type == "genre")
	{
		genre = 1;
		$("#dropdown_five").show();
		$("#replace_down_five").attr("src", base_url+'images/arrow_up.png');
	}
	if(type == "multiple")
	{
		multiple = 1;
		$("#dropdown_six").show();
		$("#replace_down_six").attr("src", base_url+'images/arrow_up.png');
	}
	if(type == "types")
	{
		types = 1;
		$("#dropdown_four").show();//alert(base_url+'images/arrow_up.png');
		$("#replace_down_four").attr("src", base_url+'images/arrow_up.png');
	}
	$(".multiple").removeClass("blue_select");
	$(".format").removeClass("blue_select");
	$(".genre").removeClass("blue_select");
	$(".types").removeClass("blue_select");
}

function removeMultiple(type)
{
	arr_format = new Array();
	arr_types = new Array();
	arr_genre = new Array();
	
	if(type == "format")
	{
		format = 0;
		
		
		$("#dropdown_two").hide();
		$("#replace_plus_two").attr("src", base_url+'images/arrow_down.png');
		$(".format").removeClass("blue_select");
		arr_format = new Array();
	}
	if(type == "genre")
	{
		
		genre = 0;
		
		$("#dropdown_five").hide();
		$("#replace_plus_five").attr("src", base_url+'images/arrow_down.png');
		arr_genre = new Array();
		$(".genre").removeClass("blue_select");
	}
	if(type == "multiple")
	{
		
		multiple = 0;
		$("#dropdown_six").hide();
		$("#replace_plus_six").attr("src", base_url+'images/arrow_down.png');
		$(".multiple").removeClass("blue_select");
		arr_format = new Array();
		arr_types = new Array();
		arr_genre = new Array();
	}
	if(type == "types")
	{
		types = 0;
		$("#dropdown_four").hide();
		$("#replace_plus_four").attr("src", base_url+'images/arrow_down.png');
		arr_types = new Array();
		$(".types").removeClass("blue_select");
	}
}

function ajaxDiscovery(page)
{
	if(format == 1)
 	{
 		$("#content_part").block();
 		type = "format";
 		var format_str = arr_format.join(",");
 		
 		$.ajax({
		   url      : '<?=base_url()?>'+'discovery/ajax_discovery',
		   type     : 'POST',
		   data     : { 'page': page, format:format_str, type:type},
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		            $("#tab1").html(resp);
		            //$("#edit_class" ).dialog( "close" );
		        }
		        $("#content_part").unblock();
		   },
		   error    : function(resp){
		   	$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 	}
 	else if(types == 1)
 	{
 		$("#content_part").block();
 		type = "types";
 		var types_str = arr_types.join(",");
 		$.ajax({
		   url      : '<?=base_url()?>'+'discovery/ajax_discovery',
		   type     : 'POST',
		   data     : { 'page': page, types:types_str,type:type },
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		            $("#tab1").html(resp);
		            //$("#edit_class" ).dialog( "close" );
		        }
		        $("#content_part").unblock();
		   },
		   error    : function(resp){
		   	$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 	}
 	else if(genre == 1)
 	{
 		$("#content_part").block();
 		type = "genre";
 		var genre_str = arr_genre.join(",");
 		$.ajax({
		   url      : '<?=base_url()?>'+'discovery/ajax_discovery',
		   type     : 'POST',
		   data     : { 'page': page, genre:genre_str,type:type },
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		            $("#tab1").html(resp);
		            //$("#edit_class" ).dialog( "close" );
		        }
		        $("#content_part").unblock();
		   },
		   error    : function(resp){
		   	$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 	}
 	else if(multiple == 1)
 	{
 		$("#content_part").block();
 		type = "multiple";
 		//alert("sdfsdaklf");
 		console.log(arr_genre)
 		console.log(arr_types)
 		console.log(arr_format)
 		
 		var genre_str = arr_genre.join(",");
 		var types_str = arr_types.join(",");
 		var format_str = arr_format.join(",");
 		var subtype = $("#subtype").val();
 		var searchCriteria = $("#searchCriteria").val();
 		$.ajax({
		   url      : '<?=base_url()?>'+'discovery/ajax_discovery',
		   type     : 'POST',
		   data     : { 'page': page, genre:genre_str, types:types_str, format:format_str, type:type, subtype:subtype, searchCriteria:searchCriteria },
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		            $("#tab1").html(resp);
		            //$("#edit_class" ).dialog( "close" );
		        }
		        $("#content_part").unblock();
		   },
		   error    : function(resp){
		   	$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 	}
 	else
 	{
 		$("#content_part").block();
 		$.ajax({
		   url      : '<?=base_url()?>'+'discovery/ajax_discovery',
		   type     : 'POST',
		   data     : { 'page': page },
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		            $("#tab1").html(resp);
		            //$("#edit_class" ).dialog( "close" );
		        }
		        $("#content_part").unblock();
		   },
		   error    : function(resp){
		   	$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 	}
	
}

function openDialog(id)
 {
 	
 	$.ajax({
               url      : '<?=base_url()?>'+'bookshelves/show_book_detail',
               type     : 'POST',
               data     : { 'id': id },
               success  : function(resp){
		$("#suc_msg").html('');
		$("#title").show();
		$("#tags").show();
		$("#review").show();
		$(".hide_sec").show();
		$(".pitchit_pop_icon").show();
		$(".think_pop_icon").show();
		$("#download").show();
		$("#ab").show();
		$("#savetitle").show();
               		
		   $("#pit_work_dialog").css('display', "block");
               	   $("#title").html(resp.workdetails_test.title_text);
               	   $("#excerpt").html(resp.workdetails_test.extract);
               	   $("#synopsis").html(resp.workdetails_test.synopsis);
               	   $("#review").html(resp.workdetails_test.self_published_text);
               	   $("#tags").html(resp.workdetails_test.tag_text);
                   
                   $(".pitchit_pop_icon").attr("onClick", "FnComposeMail('"+resp.workdetails_test.user_id+"', '"+resp.workdetails_test.full_name+"')");
                   $("#think_icn").attr("onClick", "FnComposeMail('"+resp.workdetails_test.user_id+"', '"+resp.workdetails_test.full_name+"')");
                   
                   $("#wid").val(id);
                   
                   if(resp.workdetails_test.pitch_count == 0)
                   {
                    $("#pitch_icn").css('display','none');
                   }
                   else
                   {
                    $("#pitch_icn").css('display','block');
                   }
                   
                   if(resp.workdetails_test.pitch_count_conversation == 0)
                   {
                    $("#think_icn").css('display','none');
                   }
                   else
                   {
                    $("#think_icn").css('display','block');
                   }
                   
                   if(resp.workdetails_test.work_file != '')
                   {
                    $("#download").css('display','block');
                    $("#download").html('<a href="<?=base_url()?>discovery/download/'+id+'/'+resp.workdetails_test.file_asset_id+'/'+resp.workdetails_test.user_id+'/'+resp.workdetails_test.work_file+'">'+resp.workdetails_test.work_file+'</a>');
                   }
                   else
                   {
                    $("#download").css('display','none');
                    //$("#download").hide();
                   }
                   $("#title_saved").css('display','none');
                   
               	   $(".pit_work_dialog_vw").dialog({
			close: function () {
			    
			}
		    });
                //savetitle(id);
                $("#titleval").val(id);
                
               },
               error    : function(resp){
                    $.prompt("Sorry, something isn't working right.", {title:'Error'});
               }
        });
 	
 }
 
 function savetitle()
 {
    //alert($("#titleval").val());
    $("#title_saved").css('display','block');
    var wid = $("#titleval").val();
    $.ajax({
               url      : '<?=base_url()?>'+'bookshelves/saveTitle',
               type     : 'POST',
               data     : { 'id': wid },
               success  : function(resp){
               	
		$("#title").css('display','none');
		$("#tags").css('display','none');
		$("#review").css('display','none');
		$(".hide_sec").css('display','none');
		$(".pitchit_pop_icon").css('display','none');
		$(".think_pop_icon").css('display','none');
		$("#download").css('display','none');
		$("#ab").css('display','none');
		$("#savetitle").css('display','none');
		
		 //#title #tags #review .hide_sec .pitchit_pop_icon .think_pop_icon #download #ab #savetitle
               if(resp == 1)
                   { 
			$("#suc_msg").html('<font color="green">Successfully saved the title</font>');
			
                   }
               else
                   {
		        $("#suc_msg").html('<font color="green">Already saved this title</font>');
		    
                   }    
               
               },
               error    : function(resp){
                    $.prompt("Sorry, something isn't working right.", {title:'Error'});
               }
        });
 }
 
 function removeSearchFilter(type,id,e,subtype)
 {
 	//e.remove();
 	//alert("sdlfjlsdkjfa");
 	if(type == "format")
 	{ 		
 		var index = arr_format.map(function(el) {
			  return el;
		}).indexOf(parseInt(id));
		//alert(index);
		arr_format.splice(index, 1);
 		fnSearchByFilters(type);
 	}
 	else if(type == "types")
 	{
 		var index = arr_types.map(function(el) {
			  return el;
		}).indexOf(parseInt(id));
		arr_types.splice(index, 1);
 		fnSearchByFilters(type);
 	}
 	else if(type == "genre")
 	{
 		var index = arr_genre.map(function(el) {
			  return el;
		}).indexOf(parseInt(id));
		arr_genre.splice(index, 1);
 		fnSearchByFilters(type);
 	}
 	if(type == "multiple")
 	{
 		if(subtype == "format")
 		{
 			var index = arr_format.map(function(el) {
			  return el;
			}).indexOf(parseInt(id));
			arr_format.splice(index, 1);
 		}
 		if(subtype == "types")
 		{
 			var index = arr_types.map(function(el) {
			  return el;
			}).indexOf(parseInt(id));
			arr_types.splice(index, 1);
 		}
 		if(subtype == "genre")
 		{
 			var index = arr_genre.map(function(el) {
			  return el;
			}).indexOf(parseInt(id));
			arr_genre.splice(index, 1);
 		}
 		fnSearchByFilters(type);
 	}
 	else if(type == "global")
 	{
 		
 		fnSearchByFilters("");
 	}
 	else
 	{
 		
 		fnSearchByFilters("");
 	}
 }
 function fnSearchByFilters(type)
 {
 	if(type == "format" && format == 1)
 	{
 		$("#content_part").block();
 		$("#searchValue").val("");
 		$("#search").val("");
 		$("#searchShow").val("");
 		$("#subtype").val("");
 		$("#searchCriteria").val("");
 		$("#dropdown_two").hide();
		$("#replace_down_two").attr("src", base_url+"images/arrow_down.png");
		
 		var format_str = arr_format.join(",");
 		$.ajax({
		   url      : '<?=base_url()?>'+'discovery/ajax_discovery',
		   type     : 'POST',
		   data     : { 'page': 1, format:format_str, type:type},
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		            
		            $("#tab1").html(resp);
		            $("#show_search").html( $("#show_search_inp").val());
		            $("#showSearchOptions").html($("#searchOptionsId").html());
		            $("#savedSearchBut").html('<a href="javascript:;" onclick="openSaveBox(\'format\')"><img alt="" src="<?=base_url();?>images/circle_edit.png"></a>');
		            //$("#edit_class" ).dialog( "close" );
		        }
		        $("#content_part").unblock();
		   },
		   error    : function(resp){
		   	$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 	}
 	if(type == "types"  && types == 1)
 	{
 		//alert("fjsafsdahf")
 		$("#content_part").block();
 		$("#searchValue").val("");
 		$("#search").val("");
 		$("#searchShow").val("");
 		$("#dropdown_four").hide();
 		$("#subtype").val("");
 		$("#searchCriteria").val("");
		$("#replace_down_four").attr("src", base_url+"images/arrow_down.png");
 		var types_str = arr_types.join(",");
 		$.ajax({
		   url      : '<?=base_url()?>'+'discovery/ajax_discovery',
		   type     : 'POST',
		   data     : { 'page': 1, types:types_str,type:type },
		   success  : function(resp){
		    
		        if(resp != '0'){
		            $("#tab1").html(resp);
		            $("#show_search").html( $("#show_search_inp").val());
		            $("#savedSearchBut").html('<a href="javascript:;" onclick="openSaveBox(\'types\')"><img alt="" src="<?=base_url();?>images/circle_edit.png"></a>');
		            $("#showSearchOptions").html($("#searchOptionsId").html());
		            //$("#edit_class" ).dialog( "close" );
		        }
		        $("#content_part").unblock();
		   },
		   error    : function(resp){
		   	$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 	}
 	if(type == "genre" && genre == 1)
 	{
 		$("#content_part").block();
 		$("#searchValue").val("");
 		$("#search").val("");
 		$("#searchShow").val("");
 		$("#dropdown_five").hide();
 		$("#subtype").val("");
 		$("#searchCriteria").val("");
		$("#replace_down_five").attr("src", base_url+"images/arrow_down.png");
 		var genre_str = arr_genre.join(",");
 		$.ajax({
		   url      : '<?=base_url()?>'+'discovery/ajax_discovery',
		   type     : 'POST',
		    data     : { 'page': 1, genre:genre_str,type:type },
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		            $("#tab1").html(resp);
		            $("#show_search").html( $("#show_search_inp").val());
		            $("#savedSearchBut").html('<a href="javascript:;" onclick="openSaveBox(\'genre\')"><img alt="" src="<?=base_url();?>images/circle_edit.png"></a>');
		            $("#showSearchOptions").html($("#searchOptionsId").html());
		            //$("#edit_class" ).dialog( "close" );
		        }
		         $("#content_part").unblock();
		   },
		   error    : function(resp){
		   	$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 	}
 	if(type == "multiple" && multiple == 1)
 	{
 		$("#content_part").block();
 		$("#searchValue").val("");
 		$("#search").val("");
 		$("#searchShow").val("");
 		$("#dropdown_six").hide();
 		$("#subtype").val("");
 		$("#searchCriteria").val("");
		$("#replace_down_six").attr("src", base_url+"images/arrow_down.png");
 		var genre_str = arr_genre.join(",");
 		var format_str = arr_format.join(",");
 		var types_str = arr_types.join(",");
 		$.ajax({
		   url      : '<?=base_url()?>'+'discovery/ajax_discovery',
		   type     : 'POST',
		    data     : { 'page': 1, genre:genre_str, types:types_str, format:format_str,type:type },
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		            $("#tab1").html(resp);
		           
		            $("#show_search").html( $("#show_search_inp").val());
		            $("#showSearchOptions").html($("#searchOptionsId").html());
		            $("#savedSearchBut").html('<a href="javascript:;" onclick="openSaveBox(\'multiple\')"><img alt="" src="<?=base_url();?>images/circle_edit.png"></a>');
		            //$("#edit_class" ).dialog( "close" );
		        }
		        $("#content_part").unblock();
		   },
		   error    : function(resp){
		   	$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 	}
 }
 function openSaveBox(type)
 {
 	if(arr_genre.length > 0 || arr_types.length > 0 || arr_format.length > 0 || type=="global"){
 		$("#content_part").block();
 		var genre_str = arr_genre.join(",");
 		var format_str = arr_format.join(",");
 		var types_str = arr_types.join(",");
 		$.ajax({
		   url      : '<?=base_url()?>'+'discovery/ajax_search_info',
		   type     : 'POST',
		    data     : { genre:genre_str, types:types_str, format:format_str,type:type, searchCriteria:$("#searchCriteria").val() },
		   success  : function(resp){
		    
		        $("#dropdown_four").hide();
	 		$("#dropdown_two").hide();
	 		$("#dropdown_five").hide();
	 		var filters = "";
	 		var sep = "";
	 		console.log(resp);
	 		$.each(resp,function(k,v){
	 			
	 			if(v.type == "types" || v.subtype == "types")
	 			{
	 				filters = filters + sep + v.work_type_name;
	 			}
	 			if(v.type == "format" || v.subtype == "format")
	 			{
	 				filters = filters + sep + v.work_form_name;
	 			}
	 			
	 			if(v.type == "genre" || v.subtype == "genre")
	 			{
	 				filters = filters + sep + v.category_name;
	 			}
	 			if(v.type == "global")
	 			{
	 				filters = $("#searchCriteria").val();
	 			}
	 			sep = ", ";
	 		});
	 		$("#ShowTheFilters").html(filters);
	 		//fnSaveFilter(type);
		 	$("#save_search_but").html('<input name="button" class="add_bkslf" type="button" value="Save" style="margin-left: 60px !important;" onclick="fnSaveFilter(\''+type+'\')">');
		 	$.facebox({ div: '#multipleSave' });
		        $("#content_part").unblock();
		   },
		   error    : function(resp){
		   	$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 		
 		
 	}
 }
  function ajaxSavedSearches(page)
 {
 	$("#content_part").block();
 	$.ajax({
		   url      : '<?=base_url()?>'+'discovery/ajax_saved_searches',
		   type     : 'POST',
		    data     : { 'page': page},
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		            $("#tab5").html(resp);
        		    $("#content_part").unblock();  
		            //$("#edit_class" ).dialog( "close" );
		        }
		   },
		   error    : function(resp){
		   	$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
	});
 }
 function fnSaveFilter(type)
 {
 	//alert($("#facebox input[type=text]").val());
 	if($("#facebox input[type=text]").val() == "")
 	{
 		alert("Please provide a search name.");
 		return false;
 	}
 	//$("#facebox input[type=text]").val("saved search");
 	if(type == "format")
 	{
 		$("#content_part").block();
 		$("#dropdown_two").hide();
 		var format_str = arr_format.join(",");
 		$.ajax({
		   url      : '<?=base_url()?>'+'discovery/save_filters',
		   type     : 'POST',
		    data     : { format:format_str,type:type, search_name:$("#facebox input[type=text]").val() },
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		            //$("#dropdown_six").html(resp);
		            ajaxSavedSearches(1);
		            //$("#content_part").block();
		            parent.$.facebox.close();
		        }
		   },
		   error    : function(resp){
		   	$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 	}
 	if(type == "types")
 	{
 		$("#content_part").block();
 		$("#dropdown_four").hide();
 		var types_str = arr_types.join(",");
 		$.ajax({
		   url      : '<?=base_url()?>'+'discovery/save_filters',
		   type     : 'POST',
		    data     : { types:types_str,type:type, search_name:$("#facebox input[type=text]").val() },
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		           // $("#dropdown_six").html(resp);
		            ajaxSavedSearches(1);
		            parent.$.facebox.close();
		        }
		   },
		   error    : function(resp){
		   	$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 	}
 	if(type == "genre")
 	{
 		$("#content_part").unblock();
 		$("#dropdown_five").hide();
 		var genre_str = arr_genre.join(",");
 		$.ajax({
		   url      : '<?=base_url()?>'+'discovery/save_filters',
		   type     : 'POST',
		    data     : { genre:genre_str,type:type, search_name:$("#facebox input[type=text]").val() },
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		           // $("#dropdown_six").html(resp);
		            ajaxSavedSearches(1);
		            parent.$.facebox.close();
		        }
		   },
		   error    : function(resp){
		   	$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 	}
 	if(type == "multiple")
 	{
 		$("#content_part").unblock();
 		$("#dropdown_five").hide();
 		var genre_str = arr_genre.join(",");
		var format_str = arr_format.join(",");
		var types_str = arr_types.join(",");
 		$.ajax({
		   url      : '<?=base_url()?>'+'discovery/save_filters',
		   type     : 'POST',
		    data     : { genre:genre_str,types:types_str,format:format_str,type:type, search_name:$("#facebox input[type=text]").val() },
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		           // $("#dropdown_six").html(resp);
		            ajaxSavedSearches(1);
		            parent.$.facebox.close();
		        }
		   },
		   error    : function(resp){
		   	$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 	}
 	if(type == "global")
 	{
 		$("#content_part").unblock();
 		$("#dropdown_five").hide();
 		var genre_str = arr_genre.join(",");
		var format_str = arr_format.join(",");
		var types_str = arr_types.join(",");
 		$.ajax({
		   url      : '<?=base_url()?>'+'discovery/save_filters',
		   type     : 'POST',
		   data     : {type:type, search_name:$("#facebox input[type=text]").val(), search_criteria:$("#search").val() },
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		           // $("#dropdown_six").html(resp);
		            ajaxSavedSearches(1);
		            parent.$.facebox.close();
		        }
		   },
		   error    : function(resp){
		   	$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 	}
 }
 function savedSearchesCount()
    {
        $("#dropdown_two").hide();
	$("#dropdown_four").hide();
	$("#dropdown_five").hide();
	$("#dropdown_six").hide();
    
        $("#replace_down_two").attr('src', base_url+'images/arrow_down.png');
	$("#replace_down_four").attr('src', base_url+'images/arrow_down.png');
	$("#replace_down_five").attr('src', base_url+'images/arrow_down.png');
	$("#replace_down_six").attr('src', base_url+'images/arrow_down.png');
    
 	$("#savedSearchBut").html('<img alt="" src="<?=base_url();?>images/circle_edit.png">');
 	$("#showSearchOptions").html('');
 	$("#show_search").html($("#saved_search_count").val()); 
 }
 function fnDeleteSearches(id,checkbox)
 {
 	if(checkbox.checked == true)
 	{
 		
	 	if(confirm('Are you sure to delete this Book from your Bookshelf?'))
		{
			$("#content_part").block();
	 		$.ajax({
			   url      : '<?=base_url()?>'+'discovery/ajax_delete_search',
			   type     : 'POST',
			    data     : { id:id },
			   success  : function(resp){
			    //alert(resp);
				if(resp != '0'){
				    $("#tr"+id).remove()  ;  
				}
				$("#content_part").unblock();
			   },
			   error    : function(resp){
			   	$("#content_part").unblock();
				$.prompt("Sorry, something isn't working right.", {title:'Error'});
			   }
			});
		}
		else
		{
		    
		    return false;
		}
        }
 }
 function fnViewSearches(id)
 {	
 	
 	//if(document.getElementById("checkbox"+id).checked == true)
 	//{
 		$("#content_part").block();
 		$("#subtype").val("");
 		$("#searchCriteria").val("");
 		$("#search").val("");
 		$("#searchShow").val("");
 		$("#searchValue").val("");
 		removeMultiple("format");
 		removeMultiple("types");
 		removeMultiple("genre");
 		removeMultiple("multiple");
 		$.ajax({
			   url      : '<?=base_url()?>'+'discovery/ajax_view_searches',
			   type     : 'POST',
			    data     : { id:id },
			   success  : function(resp){
			    //alert(resp);
				if(resp != '0'){
				  
				   $("#tab1").html(resp);
				   $("#show_search").html( $("#show_search_inp").val());
				   if($("#type").val() == "format")
				   {
				   	format = 1;
				   	var format_str = $("#arr").val();
				   	arr_format = format_str.split(",");
			 		console.log(arr_format);
				   }
				   if($("#type").val() == "genre")
				   {
				   	genre = 1;
				   	var genre_str = $("#arr").val();
				   	arr_genre = genre_str.split(",");
				   }
				   if($("#type").val() == "types")
				   {
				   	types = 1;
				   	var types_str = $("#arr").val();
				   	arr_types = types_str.split(",");
				   }
				   if($("#type").val() == "multiple")
				   {
				   	//alert("ksdflsdf");
				   	multiple = 1;
				   	//alert($("#multiple_types").val())
				   	var types_str = $("#multiple_types").val();
				   	var format_str = $("#multiple_format").val();
				   	var genre_str = $("#multiple_genre").val();
				   	//alert(types_str);
				   	if(genre_str != "")
				   	{
				   		arr_genre = genre_str.split(",");
				   	}
				   	if(types_str != "")
				   	{
				   		arr_types = types_str.split(",");
				   	}
				   	if(format_str != "")
				   	{
				   		arr_format = format_str.split(",");
				   	}
				   	
				   	console.log(arr_genre)	;	
				   	console.log(arr_types)	;	
				   	console.log(arr_format)	;		   	
				   }
				   $("#showSearchOptions").html($("#searchOptionsId").html());
				   $("#show_searches").click();
				   $("#content_part").unblock();
				}
			   },
			   error    : function(resp){
			   	$("#content_part").unblock();
				$.prompt("Sorry, something isn't working right.", {title:'Error'});
			   }
			});
 	//}
 }
 $('#searchValue').keyup(function (event) {
 	 var keycode = (event.keyCode ? event.keyCode : event.which);
 	if(keycode == 13) {
        
    	
 	if($("#searchValue").val() != "")
 	{
 		$("#content_part").block();
 		$("#search").val("");
 		$("#searchShow").val("");
 		$("#subtype").val("");
 		$("#searchCriteria").val("");
 		removeMultiple("format");
 		removeMultiple("types");
 		removeMultiple("genre");
 		removeMultiple("multiple");
 		var name = $("#searchValue").val();
 		$.ajax({
			   url      : '<?=base_url()?>'+'discovery/ajax_view_searches',
			   type     : 'POST',
			    data     : { id:0, name : name },
			   success  : function(resp){
			    //alert(resp);
				if(resp != '0'){
				  
				   $("#tab1").html(resp);
				   $("#show_search").html( $("#show_search_inp").val());
				   if($("#type").val() == "format")
				   {
				   	format = 1;
				   	multiple = 0;
				   	types = 0;
				   	genre = 0;
				   	var format_str = $("#arr").val();
				   	arr_format = format_str.split(",");
			 		
				   }
				   if($("#type").val() == "genre")
				   {
				   	format = 0;
				   	multiple = 0;
				   	types = 0;
				   	genre = 1;
				   	var genre_str = $("#arr").val();
				   	arr_genre = genre_str.split(",");
				   }
				   if($("#type").val() == "types")
				   {
				   	format = 0;
				   	multiple = 0;
				   	types = 1;
				   	genre = 0;
				   	var types_str = $("#arr").val();
				   	arr_types = types_str.split(",");
				   }
				   $("#show_searches").click();
				   $("#content_part").unblock();
				}
			   },
			   error    : function(resp){
			   	$("#content_part").unblock();
				$.prompt("Sorry, something isn't working right.", {title:'Error'});
			   }
			});
 	
 	}
 	}
 	
 });
 function globalSearch()
 {
 	$("#search").val($("#searchShow").val())
 	if($("#search").val() == "")
 	{
 		alert("Please provide a search criteria.")
 		return false;
 	}
 	if($("#search").val() != "")
 	{
 		//$("#subtype").val("");
 		$("#content_part").block();
 		$("#searchValue").val("");
 		removeMultiple("format");
 		removeMultiple("types");
 		removeMultiple("genre");
 		removeMultiple("multiple");
 		var name = $("#search").val();
 		$.ajax({
			   url      : '<?=base_url()?>'+'discovery/ajax_global_search',
			   type     : 'POST',
			    data     : { page:1,search_val : name },
			   success  : function(resp){
			    //alert(resp);
				if(resp != '0'){
				  
				   $("#tab1").html(resp);
				   $("#show_search").html( $("#show_search_inp").val());
				   if($("#type").val() == "multiple")
				   {
				   	format = 0;
				   	multiple = 1;
				   	types = 0;
				   	genre = 0;
				   	if($("#multiple_format").val() != "")
				   	{
				   		var format_str = $("#multiple_format").val();
				   		arr_format = format_str.split(",");
				   	}
				   	
				   	if($("#multiple_types").val() != "")
				   	{
				   		var types_str = $("#multiple_types").val();
				   		arr_types = types_str.split(",");
				   	}
				   	
				   	if($("#multiple_genre").val() != "")
				   	{
				   		var genre_str = $("#multiple_genre").val();
				   		arr_genre = genre_str.split(",");
				   	}
				   	 $("#savedSearchBut").html('<a href="javascript:;" onclick="openSaveBox(\'global\')"><img alt="" src="<?=base_url();?>images/circle_edit.png"></a>');
				   	//$("#showSearchOptions").html($("#searchOptionsId").html());
			 		$("#showSearchOptions").html('');
				   }
				  
				   $("#show_searches").click();
				   $("#content_part").unblock();
				}
			   },
			   error    : function(resp){
			   	$("#content_part").unblock();
				$.prompt("Sorry, something isn't working right.", {title:'Error'});
			   }
			});
 	}
 }
 $('#searchShow').keyup(function (event) {
 	
 	 var keycode = (event.keyCode ? event.keyCode : event.which);
 	if(keycode == 13) {
 		
 		globalSearch();
 	}
 });
 
</script>

            <div class="content_part" >
            	
                <div class="mid_content index_sec" id="content_part">
                
              <div class="pitchits_section pitchits_section_new pitchits_section_new3">
        
        <div class="filter_section">
        <!--<form action="" method="post">-->
        <div class="filter_section_search">
        <input name="searchShow" id="searchShow" type="text" value="Search..."  onfocus="if(this.value == 'Search...') {this.value=''}" onblur="if(this.value == '') {this.value='Search...'}">
        <input name="search" id="search" type="hidden" value="" placeholder="Search..." >
        <input type="button" value="" onclick="globalSearch()">
        
        </div>
        <div class="filter_section_search_results">
        
        Search Results (<span id="show_search"><?php echo $total_rows;?></span>) 
        
        <span id="savedSearchBut"><img src="<?=base_url()?>images/circle_edit.png" alt="" /></span>
		<!--<input name="searchValue" id="searchValue" type="text" value="">-->
		<span id="showSearchOptions"></span>
        
        </div>
        <!--</form>-->
        <div class="clear"></div>
        </div>
        
          <div class="pitchits_section_left">
          <div id="navigation_vert">
<style>
.li_span {
font-size: 13px !important;
font-weight: bold !important;
color: #333 !important;
text-transform: uppercase !important;
height: 45px !important;
float: left !important;
width: 100%;
}
</style>          	
            <ul class="list" id="tabs">
            <li style="display:none"><a href="#" name="tab1" id="show_searches"></a></li>
<li id="current" class="li_pad"> <span id="replace_plus_four" class="li_span" onclick="selectMultiple('types')"><img src="<?=base_url()?>images/filter_icon02.png" style="float: left; margin-right: 10px;" alt="" />Filter by Type <img src="<?=base_url()?>images/arrow_down.png" alt="" class="right_flo"  style="cursor:pointer; margin-top: 9px" id="replace_down_four" /></span>

<div class="dropdown wid250" id="dropdown_four" style="display:none">
<ul class="list">
<?php foreach($types as $val){ ?>
<li class="li_sml types types_<?php echo $val['work_type_id'];?>" onclick="saveType(<?php echo $val['work_type_id'];?>,'types')" style="cursor:pointer"><?php echo $val['work_type_name'];?></li>
<?php } ?>
<li><a href="#" class="green_bg" onclick="fnSearchByFilters('types')" name="tab1">Click to Search by Filters</a></li>
<!--<li ><a href="javascript:;" onclick="openSaveBox('types')" class="orange_bg" name="tab1">Click to Save for Multiple Filters</a></li>-->
</ul>
</div>

</li>
<li id="current" class="li_pad">
     <span id="replace_plus_two" class="li_span" onclick="selectMultiple('format')"><img src="<?=base_url()?>images/filter_icon01.png" style="float: left; margin-right: 10px;" alt="" />Filter by Format <img src="<?=base_url()?>images/arrow_down.png" alt="" class="right_flo"  style="cursor:pointer; margin-top: 9px" id="replace_down_two" /></span>
<div class="dropdown wid250" id="dropdown_two" style="display:none">

<ul class="list">
<?php foreach($formats as $val){ ?>
	<li class="li_sml format format_<?php echo $val['work_form_id'];?>"  onclick="saveFormat(<?php echo $val['work_form_id'];?>,'format')" style="cursor:pointer"><?php echo $val['work_form_name'];?></li>
<?php } ?>
<li><a href="javascript:;" class="green_bg" name="tab1" onclick="fnSearchByFilters('format')">Click to Search by Filters</a></li>
<!--<li><a href="javascript:;"  class="orange_bg" name="tab1" onclick="openSaveBox('format')">Click to Save for Multiple Filters</a></li>-->
</ul>
</div>
</li>
<li id="current" class="li_pad">
    <span id="replace_plus_five" class="li_span" onclick="selectMultiple('genre')"><img src="<?=base_url()?>images/filter_icon03.png" style="float: left; margin-right: 10px;" alt="" />Filter by Genre <img src="<?=base_url()?>images/arrow_down.png" alt="" class="right_flo"  style="cursor:pointer; margin-top: 9px" id="replace_down_five" /></span>

<div class="dropdown" id="dropdown_five"  style="display:none">
<ul class="list">
<?php 
$count = 0;
$catcount = count($categories);
$avg = ceil($catcount / 3);
//echo $avg;
foreach($categories as $val){ 
    if($count >= $avg && $count % $avg == 0 && $count < $catcount)
{
	echo "</ul><ul class='list'>";
}
    ?>
<li class="li_sml genre genre_<?php echo $val['id'];?>" onclick="saveGenre(<?php echo $val['id'];?>,'genre')" style="cursor:pointer"><?php echo $val['category_name'];?></li>

<?php 
if($count == $catcount -1)
{
	echo '<li><a href="#" class="green_bg" name="tab1" onclick="fnSearchByFilters(\'genre\')">Click to Search by Filters</a></li>';
	//echo '<li><a href="javascript:;" class="orange_bg" onclick="openSaveBox(\'genre\')" name="tab1">Click to Save for Multiple Filters</a></li>';
}

$count++;

} ?>
</ul>

</div>
</li>
<li id="current" class="li_pad">
     <span id="replace_plus_six" class="li_span" onclick="selectMultiple('multiple')"><img src="<?=base_url()?>images/filter_icon04.png" style="float: left; margin-right: 10px;" alt="" />Filter by Multiple <img src="<?=base_url()?>images/arrow_down.png" alt="" class="right_flo"  style="cursor:pointer; margin-top: 9px" id="replace_down_six" /></span>

<div class="dropdown" id="dropdown_six"  style="display:none">
<ul class="list">
<li><a href="#"><strong>Filters by Type</strong></a></li>
<?php if(isset($types)){
foreach($types as $val){ ?>
<li class="li_sml multiple multiple_types_<?php echo $val['work_type_id'];?>" onclick="saveMultiple(<?php echo $val['work_type_id'];?>,'multiple','types')" style="cursor:pointer"><?php echo $val['work_type_name'];?></li>
<?php 
}
} ?>
</ul>
<ul class="list">
<li><a href="#"><strong>Filters by Format</strong></a></li>
<?php 
if(isset($formats)){
foreach($formats as $val){ ?>
	<li class="li_sml  multiple multiple_format_<?php echo $val['work_form_id'];?>" onclick="saveMultiple(<?php echo $val['work_form_id'];?>,'multiple','format')" style="cursor:pointer"><?php echo $val['work_form_name'];?></li>
<?php 
}
} ?>
</ul>
<ul class="list">
<li><a href="#"><strong>Filters by Genre</strong></a></li>
<?php 
$count = 0;
if(isset($categories)){
foreach($categories as $val){ 
    
    if($count >= $avg && $count % $avg == 0 && $count < $catcount)
{
	echo "</ul><ul class='list'>";
}
    
    ?>
	<li class="li_sml  multiple multiple_genre_<?php echo $val['id'];?>" onclick="saveMultiple(<?php echo $val['id'];?>,'multiple','genre')" style="cursor:pointer"><?php echo (strlen($val['category_name']) > 20)? substr($val['category_name'],0,20).'..' : $val['category_name'];?></li>
<?php 
if($count == $catcount -1)
{
	echo '<li><a href="javascript:;" class="green_bg" name="tab1"  onclick="fnSearchByFilters(\'multiple\')">Click to Search by Filters</a></li>';
}

$count++;

}
} ?>

</ul>
</div>


</li>
<li><a href="javascript:;" name="tab5" onclick="savedSearchesCount()"><img src="<?=base_url()?>images/circle_edit.png" alt="" /> Saved Searches</a></li>
            </ul>
            
            </div>
          </div>
          <div class="pitchits_section_right" id="content">
          
          
          	<div style="display: block;" id="tab1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th align="center" width="22%">Author</th>
                  <th align="center" width="25%">Title</th>
                  <th align="center" width="15%">Type</th>
                  <th align="center" width="18%">Format</th>
                  <th align="center" width="20%">Genre</th>
                </tr>
              </thead>
              <tbody id="containerid">
              	<?php
              	 if(!empty($discovery))
                {
                $i =1;
		
                 foreach($discovery as $details)
                 {
               ?>
                <tr >
                  <td align="center">
               
                  <?php if($details['user_image'] != '') {?>
		    <img src="<?=base_url()?>uploadImage/<?=$details['user_id']?>/profile/thumbs/<?=$details['user_image'];?>" style="border: 1px solid #444;"/>
		    <?php } else { ?>
		    <img src="<?=base_url()?>images/img_default_cover.png" style="border: 1px solid #444;"/>
		    <?php } ?>
            
            <?php if(strlen($details['name_first'].' '.$details['name_middle'].' '.$details['name_last']) > 10) {?>
            
             <a class="tooltips" href="<?=base_url()?>discovery/user_details/<?=$details['user_id'];?>">
                   
                  <label style="cursor: pointer;">
			
			<?php echo substr($details['name_first'].' '.$details['name_middle'].' '.$details['name_last'],0,10)."..."?>
			
		  </label> 
                  
                  <span class="tp_span_disc"><?php echo $details['name_first'].' '.$details['name_middle'].' '.$details['name_last'];?></span>
 <div class="clear"></div>
                  <?php //echo (strlen($details['name_first'].' '.$details['name_middle'].' '.$details['name_last']) > 15) ? substr($details['name_first'].' '.$details['name_middle'].' '.$details['name_last'],0,15)."..." : $details['name_first'].' '.$details['name_middle'].' '.$details['name_last'];?>
                   
                   
               </a> 
               
               
             <?php } else {?>
                    <a class="tooltips" href="<?=base_url()?>discovery/user_details/<?=$details['user_id'];?>">
             <?php echo $details['name_first'].' '.$details['name_middle'].' '.$details['name_last'];?>
                    </a>
             <?php } ?> 
            
                   </td>
                   
                   
                <td align="center">
                 <a class="tooltips" onclick="openDialog('<?php echo $details['id'];?>')">
                     <?php if(strlen($details['title']) > 15) {?>
                     <label style="cursor: pointer;"><?php echo substr($details['title'],0,15)."...";?></label> 
                     <span class="tp_span_disc"><?php echo $details['title'];?></span>
                     <div class="clear"></div>

                 <?php } else {?>
                     <?php echo $details['title'];?>
                     <?php } ?> 
                 </a>
                </td>
                   
                   
                   
<!--                  <td align="center" ><span style="cursor: pointer;"  onclick="openDialog(<?php echo $details['id'];?>)"><?php if(strlen($details['title']) > 15){ echo substr($details['title'],0,15)."..."; }else{ echo $details['title']; }?></span></td>-->
                  
                  
                  
                  
                  <td align="center"> <?php echo $details['type_name'];?></td>
                  <td align="center"><?php echo $details['form_name'];?></td>
                  
                <td align="center">
                    <a class="tooltips" href="javascript:void(0)">
                        <?php if(strlen($details['category_name']) > 11) {?>
                        <label style="cursor: pointer;"><?php echo substr($details['category_name'],0,11)."...";?></label> 
                        <span class="tp_span_disc"><?php echo $details['category_name'];?></span>
                        <div class="clear"></div>

                    <?php } else {?>
                        <?php echo $details['category_name'];?>
                        <?php } ?> 
                    </a>
                </td>
                  
                  
                </tr>
               
                <?php
                }
                }
                 ?>
              </tbody>
            </table>
           <div class="button_right"><?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but" onclick="ajaxDiscovery(<?php echo $page-1;?>)">PREVIOUS</a>
            <?php } ?> <?php if($total_rows > $offset){ ?><a href="javascript:;" onclick="ajaxDiscovery(<?php echo $page+1;?>)" class="blue_but">VIEW MORE</a>
            <?php }else{?> ><a href="javascript:;" class="blue_but">VIEW MORE</a> <?php } ?></div>
           
           <input type="hidden" name="subtype" id="subtype" value="">
            <input type="hidden" name="searchCriteria" id="searchCriteria" value="">
            <div style="display:none" id="searchOptionsId"></div>
            
            </div>
		
            <!---------Popup dialog---------->
           
           <div class="pit_work_dialog_vw" style="display: none;" id="pit_work_dialog">
                  
               
                <div id="suc_msg"></div>
                  <h4 id="title"></h4>

<p ><span id="tags"><span><br>
<span id="review"></span>
</p>
<div class="hide_sec">

<h4>Synopsis</h4>

<p id="synopsis"></p>

<h4>Excerpt</h4>

<p id="excerpt"></p>

</div>
                  
<a href="#" class="pitchit_pop_icon" id="pitch_icn"><img src="<?php echo base_url()?>/images/icon_p.png"></a>  
<a href="#" class="think_pop_icon" id="think_icn"><img src="<?php echo base_url()?>/images/think.png"></a>
<span id="download"></span> 
                    <a  href="#bookshelf" id="ab" rel="facebox">Add to Bookshelf</a>
                    <a class="brown_but" id="savetitle" style="cursor: pointer;" onclick="savetitle()">Save Title</a>
                    <input type="hidden" id="titleval" value="">
			
                    <a href="javascript:void(0);" class="green_but" id="cancl_pit">Close</a>
                    
                  </div>
           
           <!----------End------------------>
          
                  <!--------------------Add bookshelf Popup--------------------->       
            <div id="bookshelf" style="display:none;">
             <h2>Add to Bookshelf</h2>
             <?php
              // $frmAttrs   = array("id"=>'addBookshelf',"class"=>'form-horizontal',"name"=>'myform');
               //echo form_open('bookshelves/addToBookShelves', $frmAttrs);
             ?>
             <div style="width: 100%;">
             <span style="float: left; padding-right: 10px;">
            <div class="styled-select">
               <select name="bkself_id" id="bkself_id"  class="select_box2">
                  <option value="0">Select</option>
                  <?php 
                  $bself_list = $this->mbookshelf->get_rest_bookshelf(1);
                  //echo '<pre/>';print_r($bself_list);die;
                  if(!empty($bself_list))
                  {
                   foreach($bself_list as $blist)
                   {
                  ?>
                  <option value="<?=$blist['id']?>"><?=$blist['name']?></option>
                  <?php } } ?>
               </select>
            </div>
              </span>                          
             <span style="float: left;">
		 <input type="hidden" name="aaa" id="aaa"  />
             <input type="hidden" name="wid" id="wid" value="" />
             <input name="button" class="add_bkslf" type="submit" onclick="ad_bshelf()" value="Add"  />
             </span>
             <div class="clear"></div>
             </div>
            <!-- </form> -->
             
              </div>
            
 <!-------------------------End Popup--------------------------------------------->     
            
            
          	<div style="display: none;" id="tab5">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>              	
                <tr>
                  <th align="center" width="30%">Search</th>
                  <th align="center" width="20%">Date</th>
                  <th align="center" width="20%">Titles Returned</th>
                  <th align="center" width="15%">View Search</th>
                  <th align="center" width="15%" class="center">Delete</th>
                </tr>
              </thead>
              <tbody>
              	<?php foreach($getSavedSearches as $val){ ?>
                <tr id="tr<?php echo $val['id'];?>">
                  <td align="center"><?php echo $val['saved_search_name'];?></td>
                  <td align="center"><?php echo date('m/d/Y', strtotime($val['create_date']));?></td>
                  <td align="center"> <?php echo $val['titles_returned'];?></td>
                  <td align="center" class="img_new">
                  <?php /*<input name="check" type="checkbox" id="checkbox<?php echo $val['id'];?>" value="<?php echo $val['id'];?>" onclick="fnViewSearches('<?php echo $val['id'];?>')">*/?>
                   <img src="<?=base_url()?>images/discevory_view.png" alt="" style="cursor:pointer;" onclick="fnViewSearches('<?php echo $val['id'];?>')">
                  </td>
                  <td align="center" class="center"><input name="check" type="checkbox" value="<?php echo $val['id'];?>" onclick="fnDeleteSearches('<?php echo $val['id'];?>',this)"></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
           <div class="button_right"><?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but" onclick="ajaxSavedSearches(<?php echo $page_ss-1;?>)">PREVIOUS</a> <?php } ?> <?php if($total_rows_ss > $offset+5){ ?><a href="javascript:;" onclick="ajaxSavedSearches(<?php echo $page_ss+1;?>)" class="blue_but">VIEW MORE</a><?php }else{?> <a href="javascript:;" class="blue_but">VIEW MORE</a> <?php } ?></div>
           <input type="hidden" name="saved_search_count" id="saved_search_count" value="<?php echo $total_rows_ss;?>">
            </div>
            
          </div>
          
          <div class="clear"></div>
        </div>
                  
                    
                </div>
                <div class="clear"></div>
 <div id="multipleSave" style="display:none;">
 <!--<h2>Save Searches</h2>-->
 <label>Name: </label>
 <input name="bookshelf" type="text" id="save_search_box" name="save_search_box">
 <div class="clear"></div>
 <label>Filters: </label>
 <span id="ShowTheFilters" class="ShowTheFilters"></span>
  <div class="clear"></div>
 <span id="save_search_but"><input name="button" class="add_bkslf" type="button" value="Save" style="margin-left: 60px !important;"></span>
  </div>   
                
              
                
<?=$this->load->view('template/search.php')?>         
                
<?=$this->load->view('template/inner_footer.php')?>  

<style>
.fileContainer {
    overflow: hidden;
    position: relative;
}

.fileContainer [type=file] {
    cursor: inherit;
    display: block;
    font-size: 999px;
    filter: alpha(opacity=0);
    min-height: 100%;
    min-width: 100%;
    opacity: 0;
    position: absolute;
    right: 0;
    text-align: right;
    top: 0;
}

/* Example stylistic flourishes */

.fileContainer {
    
    border-radius: .5em;
    float: left;
    padding: .5em;
}

.fileContainer [type=file] {
    cursor: pointer;
}

</style>

<div class="cd-popup" role="alert">
    <div class="cd-popup-container">
        <div style=" width:100%; background:#000; padding:20px 0;">

        </div>
        <div class="top_compose">
                                
            <?php
            $usd = $this->session->userdata('logged_user');
            $frmAttrs   = array("id"=>'composeFrm',"class"=>'form-horizontal',"name"=>'myForm');
            echo form_open_multipart('mail/compose', $frmAttrs);
            ?>
             <!--<a href="#" class="closelabel_new"><img src="<?//=base_url()?>images/closelabel.png" alt="" /></a>-->
             <div class="text_field_box"><label style="float:left; margin-top:9px; width:3%">To</label>

             <input type="hidden" id="user_mail" name="user_mail" readonly="readonly"/>
              <div  class="auto_main" id="parent_email_selected">				
                 <span id="email_selected">

                 </span>
                 <span>
                 <input type="text" autocomplete="off" class="auto_t_box" id="email_input" name="email_input" onkeyup='FnShowSearch(this.value)'>
                 <ul id="dropdown_search" style="display:none;">
                 </ul>
                 </span>

             </div>

             <input type="hidden" id="user_email_id" name="user_email_id"/>
              <label class="com_plus"> <a href="#showAuthorList" class="nohover add_img" rel="facebox" data-url=""><img src="<?php echo base_url('images/plus_icon.png')?>" /></a></label>


                 <div class="clear"></div>
             </div>
             <div class="text_field_box3"><label style="float:left; margin-top:9px;">Subject</label>

             <input type="text" id="sub" name="sub" class="sub_mail_content" value="" >
             <div class="clear"></div>

             </div>
             <div class="comm_tarea">
                 <textarea class="ckeditor" cols="80" name="desc"  id="desc" > </textarea>
             </div>
                 <div class="clear"></div><br />

             <div class="button_set button_set2"> 
                 <input name="send" type="button" value="Send" class="button" onclick="SubmitForm1('send')" />
                 <?php //if($usd['user_type'] == "2"){ ?>
                 <input name="draft" type="button" value="Save Draft" class="button" style="margin-right:0 !important;" onclick="SubmitForm1('draft')"/>
                 <?php //} ?>
                 <label class="fileContainer">
                 <img src="<?=base_url()?>images/attachment_icon.png" alt=""   /> 
                 <input type="file" id="image" name="image" onchange="myFunction()"/>
                 <span id="demo_upload"></span>
                 </label>

            <a href="javascript:void(0);"><img src="<?=base_url()?>images/delete_new.png" alt="" /></a>

                               </div>

            <div class="clear">  </div>
            </form> 
        </div>
                                
        <a href="#0" class="cd-popup-close img-replace">Close</a>
        <div class="clear"></div>
    </div> 
    <div class="clear"></div>
</div>                
<script>
	
	function ad_bshelf() {
		
		//var bk = $('#bkself_id :selected').val();
		//alert('===='+bk);
		var wid = $("#wid").val();
		$.ajax({
			type:'POST',
			url:BASE+'bookshelves/addToBookShelvesAjax',
			data:{bkself_id:bkself_id,wid:wid},
			dataType:'json',
			success:function(data){
				//alert(data);
			   if (data==1) {
				
				$("#facebox").hide();
			   }
			}
		});
   
	}
$(document).ready(function()
{
	
	
    $('.cd-popup-close').click(function(event){
        event.preventDefault();
        $('.cd-popup').removeClass('is-visible');
        //window.location='<?=base_url()?>discovery';
        //document.getElementById('composeFrm').action='<?=base_url()?>mail/compose/draft';
        //document.getElementById('composeFrm').submit();
     
           return true;
    })
});

function FnShowSearch(value)
{
	$("#dropdown_search").hide();
	if(value == "")
	{
		return false;
	}
	
	$.ajax({
                type:'POST',
                url:BASE+'home/search_authors',
		data:{value:value},
                dataType:'json',
                success:function(data){
                    var ps = data.email;
                    var html='';
                   
                    if(data.status == "1")
                    {
                    	$("#dropdown_search").html('');
                    	if(ps.length > 0)
                    	{
                    	for (var i = 0, p; p = ps[i++];) 
                        {
                            var html='';
                            var name = p.name_first+" "+p.name_middle+" "+p.name_last;
                            html += '<li>';
                            html += '<a href="javascript:;" onclick="FnAddEmail(\''+p.id+'\',\''+name+'\')">'+name+'</a>' ;
                            
                            
		            html += '</li>';
		            html += '<div class="clear"></div>';
                            $("#dropdown_search").append(html);                  
                        }
                        $("#dropdown_search").show();
                        }
                        
                    }
                }
     });
}

function FnAddEmail(id,name)
{
	 var ids = $("#user_email_id").val();
	 
	 var arr = ids.split(",");
	 var index = arr.map(function(el) {
		return parseInt(el);
	}).indexOf(parseInt(id));
	if(index <= -1)
	{
		$("#email_selected").append('<span class="choosen" id="name'+id+'" >'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail(this,'+id+')" ></span>');
		
		
		var val = $("#user_mail").val();
	
		if(val.trim() != "")
		{
		    	val = val + ", " + name;   	
		    	$("#user_mail").val(val.trim());    	
		}
		else
		{
	    		$("#user_mail").val(name);
		}
	    
	        val = ids;
		if(val.trim() != "")
		{
	    		val = val + "," + id;
	    		$("#user_email_id").val(val.trim());
		}
		else
		{
	    		$("#user_email_id").val(id);
		}
	}
	$("#email_input").val('');
	$("#dropdown_search").hide();
	$("#dropdown_search").html('');
}

function SubmitForm1(type)
{
    //alert('fg');
    var pgnd = document.getElementById("user_email_id").value.trim();
    if(pgnd == "")
    {
        alert('Email should not be empty...');
        document.getElementById("user_email_id").focus();
        return false;
    }   
   else
   {
     document.getElementById('composeFrm').action='<?=base_url()?>mail/compose/'+type;
     document.getElementById('composeFrm').submit();
     //window.location.reload();
     return true;
    } 
}
function FnComposeMail(id,name)
{
    $('.cd-popup').addClass('is-visible');
    $("#pit_work_dialog").css('display', "none");
    
    $("#user_mail").val(name);
    $("#user_email_id").val(id);
    $("#email_selected").html('<span class="choosen" id="name'+id+'">'+name+'</span>');
    
    
    
    
    var ids = $("#user_email_id").val();
    var arr = ids.split(",");
    var index = arr.map(function(el) {
        return parseInt(el);
    }).indexOf(parseInt(id));
         if(index <= -1)
         {
            var val = $("#user_mail").val();
            if(val.trim() != ""){
                val = val + ", " + name;
                $("#user_mail").val(val.trim());
            }
            else
            {
                $("#user_mail").val(name);
            }
            val = ids;
            if(val.trim() != "")
            {
                val = val + "," + id;
                $("#user_email_id").val(val.trim());
            }
            else
            {
                $("#user_email_id").val(id);
            }
//            $("#email_selected").append('<span class="choosen" id="name'+id+'" >'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail(this,'+id+')" ></span>');
            $("#email_selected").append('<span class="choosen" id="name'+id+'" >'+name+'</span>');
        }
}

function removeEmail(div,id)
{
	if(parseInt(id) > 0)
	{
		//alert(id);
		$("#name"+id).remove();
		var val = $("#user_email_id").val();
		var arr = val.split(",");
		//console.log(arr);
		var index = arr.map(function(el) {
		  return parseInt(el);
		}).indexOf(parseInt(id));	
		//alert(index);
		if(index > -1){
			arr.splice(index, 1);	
		}
		if(arr.length > 0){
			var v = arr.join(",");
			//alert(v);
			$("#user_email_id").val(v);
		}
		else
		{
			var v = "";
			$("#user_email_id").val(v);
		}
		
	}
}
</script>

<script src="<?=base_url()?>ckeditor/ckeditor.js"></script>
