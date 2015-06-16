function reply_send(id)
{
    $.ajax({
        url      : BASE+'home/reply_send',
        type     : 'POST',
        data     : { 'id':id },
        success  : function(data){

            var res = data.split("~");
            $('#user_mail_reply').val(res[1]);
            $('#reply_message_id').val(id);
            $('#message_id').val(id);
         
            $("#email_selected_reply").html('<span class="choosen" id="fullname">'+res[1]+'</span>');
            $('#user_email_id_reply').val(res[4]);
            $('#reply_email').val(res[0]);
            //$('#fullname').html(res[1]);
            $('#reply_sub').val(res[2]);
         
            CKEDITOR.instances['replyall_text'].setData(res[3]);
         //alert(res[1]);
         
         //$('#user_name_reply').val(res[1]);

         },
        error : function(resp){
               $.prompt("Sorry, something isn't working right.", {title:'Error'});
            }
         });    
    
}

function FnAuthors_common(id,page,per_page, type)
{

    $.ajax({
            type:'POST',
            url:BASE+'home/authors_page',
            data:{id:id,page:page,per_page:per_page},
            dataType:'json',
            success:function(data){
                var html = '';
                if(data['status'] == "1")
                {
                    var ps = data['author_list'];

                    for (var i = 0, p; p = ps[i++];) 
                    {
                         html += '<span class="selectAuthor_'+type+'" data-num="'+i+'" style="background: #d0e6fe;color:#333;border-radius:4px;padding: 5px;margin: 0 10px 5px 0;cursor:pointer; float: left;width:45% ;" data-id="'+p.id+'" data-name="'+p.name_first+" "+p.name_middle+" "+p.name_last+'" data-type="'+type+'">';
                         html += p.name_first+" "+p.name_middle+" "+p.name_last;        
                         html += '</span>';
                         if(i%2==0)
                         {

                              html += '<div class="clear" style="margin-bottom: 10px;"></div>';

                         }	    

                    }
                    html += data['pagination']; 
                }
                else if(data['status'] == "2")
                {
                    html = "User is not logged In.Please refresh the page and log in again.";
                }
                else
                {
                    html = 'No Authors Available.';
                }

                $(".dynamic_data").html(html);
                $(".selectAuthor_"+type).on('click' , function(){
                        var name   = $(this).attr('data-name');
                         var id   = $(this).attr('data-id');
                        cancl();
                        //$("#showAuthorList").css("display","none");
                        var ids = $("#user_email_id_"+type).val();
                         var arr = ids.split(",");
                         var index = arr.map(function(el) {
                               return parseInt(el);
                         }).indexOf(parseInt(id));
                         if(index <= -1)
                         {
                                var val = $("#user_mail_"+type).val();
                                if(val.trim() != "")
                                {
                                    val = val + ", " + name;

                                    $("#user_mail_"+type).val(val.trim());

                                }
                                else
                                {
                                    $("#user_mail_"+type).val(name);
                                }
                                val = ids;
                                if(val.trim() != "")
                                {
                                    val = val + "," + id;
                                    $("#user_email_id_"+type).val(val.trim());
                                }
                                else
                                {
                                    $("#user_email_id_"+type).val(id);
                                }alert('<span class="choosen" id="name'+id+'" >'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail_"'+type+'"(this,'+id+')" ></span>')
                                $("#email_selected_"+type).append('<span class="choosen" id="name'+id+'" >'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail_"'+type+'"(this,'+id+')" ></span>');
                        }
                    })

            }
 });
}



$(document).bind('reveal.facebox', function() { 

     $(".selectAuthor_reply").on('click' , function(){
        var name   = $(this).attr('data-name');
        var id   = $(this).attr('data-id');
        var type   = $(this).attr('data-type');
        cancl();
        //$("#showAuthorList").css("display","none");
        var ids = $("#user_email_id_"+type).val();
        //alert(id+", "+name+", "+type)
         var arr = ids.split(",");
         var index = arr.map(function(el) {
               return parseInt(el);
         }).indexOf(parseInt(id));
         if(index <= -1)
         {
        var val = $("#user_mail_"+type).val();
        if(val.trim() != "")
        {
            val = val + ", " + name;
            $("#user_mail_"+type).val(val.trim());
        }
        else
        {
            $("#user_mail_"+type).val(name);
        }
        var val = ids;
        if(val.trim() != "")
        {
            val = val + "," + id;
            $("#user_email_id_"+type).val(val.trim());
        }
        else
        {
            $("#user_email_id_"+type).val(id);
        }

        $("#email_selected_"+type).append('<span class="choosen" id="name'+id+'">'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail_draft(this,'+id+')"></span>');
        }

        //alert('hi'); 

    })
        
        
})


function FnShowSearch_reply(value, type)
{
	$("#dropdown_search_"+type).hide();
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
                    	$("#dropdown_search_"+type).html('');
                    	if(ps.length > 0)
                    	{
                    	for (var i = 0, p; p = ps[i++];) 
                        {
                            var html='';
                            var name = p.name_first+" "+p.name_middle+" "+p.name_last;
                            html += '<li>';
                            html += '<a href="javascript:;" onclick="FnAddEmail_reply(\''+p.id+'\',\''+name+'\',\'reply\')">'+name+'</a>' ;
                            
                            
		            html += '</li>';
		            html += '<div class="clear"></div>';
                            $("#dropdown_search_"+type).append(html);                  
                        }
                        $("#dropdown_search_"+type).show();
                        }
                        
                    }
                }
     });
}

function FnAddEmail_reply(id,name, type)
{
	 var ids = $("#user_email_id_"+type).val();
	 
	 var arr = ids.split(",");
	 var index = arr.map(function(el) {
		return parseInt(el);
	}).indexOf(parseInt(id));
	if(index <= -1)
	{
            $("#email_selected_"+type).append('<span class="choosen" id="name'+id+'" >'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail_reply(this,'+id+',\''+type+'\')" ></span>');
		
		
		var val = $("#user_mail_"+type).val();
	
		if(val.trim() != "")
		{
		    	val = val + ", " + name;   	
		    	$("#user_mail_"+type).val(val.trim());    	
		}
		else
		{
	    		$("#user_mail_"+type).val(name);
		}
	    
	        val = ids;
		if(val.trim() != "")
		{
	    		val = val + "," + id;
	    		$("#user_email_id_"+type).val(val.trim());
		}
		else
		{
	    		$("#user_email_id_"+type).val(id);
		}
	}
	$("#email_input_"+type).val('');
	$("#dropdown_search_"+type).hide();
	$("#dropdown_search_"+type).html('');
}

function removeEmail_reply(div,id, type)
{
	if(parseInt(id) > 0)
	{
		//alert(id);
		$("#name"+id).remove();
		var val = $("#user_email_id_"+type).val();
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
			$("#user_email_id_"+type).val(v);
		}
		else
		{
			var v = "";
			$("#user_email_id_"+type).val(v);
		}
		
	}
}


function forword_send(id)
{
    $('#user_mail_1').val("");
    $('#dropdown_search_1').html("");
    $("#email_selected_1").html('');
    $('#user_email_id_1').val("");
    $('#sub').val("");
         
}