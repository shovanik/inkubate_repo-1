function showEditPitchit(pit_id)
{
  $("#pit_msg"+pit_id).hide();
  $("#hide_pit_msg"+pit_id).show();
}

function savePitchit(pit_id)
{
  var pitchit = $("#pitchit_msg"+pit_id).val();
  $.ajax({
     url      : base_url+'dashboard/savePitchit',
     type     : 'POST',
     data     : { 'pit_id': pit_id, 'pitchit': pitchit},
     success  : function(resp){
      //alert(resp);
        if(resp != '0'){
          if(resp.length > 15){
            var res = resp.substring(0, 15);
            $("#pit_work_lat_first_save_"+pit_id).html(res+"...");
          }else{
            $("#pit_work_lat_first_save_"+pit_id).html(resp);
          }
          $("#hide_pit_msg"+pit_id).hide();
          $("#pit_msg"+pit_id).show();
          $("#pit_msg"+pit_id).html(resp);
          
          
        }
     },
     error    : function(resp){
      //$("#content_part").unblock();
          $.prompt("Sorry, something isn't working right.", {title:'Error'});
     }
  });
}

function deletePitchit(pit_id, wid)
{
  var pitchit = confirm("Do you really want to delete?");
  if(pitchit){
    $.ajax({
     url      : base_url+'dashboard/deletePitchit_publisher',
     type     : 'POST',
     data     : { 'pit_id': pit_id, 'wid': wid},
     success  : function(resp){
      //alert(resp);return false;
        if(resp != '0'){
          ajaxSavedPitchit(1);
          
        }
      },
      error    : function(resp){
      //$("#content_part").unblock();
        $.prompt("Sorry, something isn't working right.", {title:'Error'});
      }
    });
  }
}

/*function ajaxLatestPitchit(page_latest)
{
    $.ajax({
       url      : base_url+'home/ajax_latest_pitchit_search',
       type     : 'POST',
       data     : { 'page_latest': page_latest, 'limit_latest' : 5},
       beforeSend: function() {
          $(".loader_file").show();
       },
       success  : function(resp){
        //alert(resp);
            if(resp != '0'){
                $("#tab1").html(resp);
                $(".loader_file").hide();
            }
       },
       error    : function(resp){
          $(".loader_file").hide();
          $.prompt("Sorry, something isn't working right.", {title:'Error'});
       }
    });
        
}

function ajaxSavedPitchit(page_saved)
{
    $.ajax({
       url      : base_url+'pitchit/ajax_saved_pitchit_search',
       type     : 'POST',
       data     : { 'page_saved': page_saved, 'limit_saved' : 5},
       beforeSend: function() {
          $(".loader_file").show();
       },
       success  : function(resp){
        //alert(resp);
            if(resp != '0'){
                $("#tab2").html(resp);
                $(".loader_file").hide();
            }
       },
       error    : function(resp){
          $(".loader_file").hide();
          $.prompt("Sorry, something isn't working right.", {title:'Error'});
       }
    });
}

function ajaxViewallPitchit(page_viewall)
{
    $.ajax({
       url      : base_url+'pitchit_search/ajax_viewall_pitchit_search',
       type     : 'POST',
       data     : { 'page_viewall': page_viewall, 'limit_viewall' : 5},
       beforeSend: function() {
          $(".loader_file").show();
       },
       success  : function(resp){
        //alert(resp);
            if(resp != '0'){
                $("#tab3").html(resp);
                $(".loader_file").hide();
            }
       },
       error    : function(resp){
          $(".loader_file").hide();
          $.prompt("Sorry, something isn't working right.", {title:'Error'});
       }
    });
}

function ajaxTotalPitchit(page_total)
{
    $.ajax({
       url      : base_url+'pitchit_search/ajax_total_pitchit_search',
       type     : 'POST',
       data     : { 'page_total': page_total, 'limit_total' : 5},
       beforeSend: function() {
          $(".loader_file").show();
       },
       success  : function(resp){
        //alert(resp);
            if(resp != '0'){
                $("#tab5").html(resp);
                $(".loader_file").hide();
            }
       },
       error    : function(resp){
          $(".loader_file").hide();
          $.prompt("Sorry, something isn't working right.", {title:'Error'});
       }
    });
}

function ajaxResponsePitchit(page_resp)
{
    $.ajax({
       url      : base_url+'pitchit_search/ajax_response_pitchit_search',
       type     : 'POST',
       data     : { 'page_resp': page_resp, 'limit_resp' : 5},
       beforeSend: function() {
          $(".loader_file").show();
       },
       success  : function(resp){
        //alert(resp);
            if(resp != '0'){
                $("#tab4").html(resp);
                $(".loader_file").hide();
            }
       },
       error    : function(resp){
          $(".loader_file").hide();
          $.prompt("Sorry, something isn't working right.", {title:'Error'});
       }
    });
}*/

function changeRank(rank, pit_id)
{//alert(pit_id);return false;
    $.ajax({
       url      : base_url+'pitchit/changeRank',
       type     : 'POST',
       data     : { 'rank': rank, 'pit_id':pit_id},
       beforeSend: function() {
          $('#rank').prop('disabled', 'disabled');
       },
       success  : function(resp){
        //alert(resp);
            if(resp != '0'){
                $('#rank').prop('disabled', false);
            }
       },
       error    : function(resp){
          //$(".loader_file").hide();
          $.prompt("Sorry, something isn't working right.", {title:'Error'});
       }
    });
}


function getPitchit(page, tab_id, type)
{//alert(type+". "+tab_id);return false;
    $.ajax({
       url      : base_url+'pitchit/ajax_pitchit_search',
       type     : 'POST',
       data     : { 'page': page, 'tab_id' : tab_id, 'type' : type},
       beforeSend: function() {
          if(type == 'pitchit'){
            $(".loader_file").show();
          }else{
            $(".whats_loader").show();
          }
          
       },
       success  : function(resp){
        //alert(resp);
            if(resp != '0'){
                $(".loader_file").hide();
                $(".whats_loader").hide();
                $("#"+tab_id).html(resp);
            }
       },
       error    : function(resp){
          $(".loader_file").hide();
          $(".whats_loader").hide();
          $.prompt("Sorry, something isn't working right.", {title:'Error'});
       }
    });
}
