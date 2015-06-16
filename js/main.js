jQuery(document).ready(function($){
//-------------------Compose mail open popup start-------------------------------//
    //open popup
    $('.cd-popup-trigger').on('click', function(event){
        event.preventDefault();
        $('.cd-popup').addClass('is-visible');
        $('.reply-popup').removeClass('is-visible');
        $('.forward-popup').removeClass('is-visible');
        $('.replyall-popup').removeClass('is-visible');
    });

    //close popup
    $('.cd-popup').on('click', function(event){
        if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') ) {
                event.preventDefault();
                $(this).removeClass('is-visible');
        }
    });

    //close popup when clicking the esc keyboard button
    $(document).keyup(function(event){
        if(event.which=='27'){
            $('.cd-popup').removeClass('is-visible');
            $('.reply-popup').removeClass('is-visible');
        }
    });
    
//----------------------Replay mail open popup start-------------------------//    
    //open reply popup
    $('.reply-popup-trigger').on('click', function(event){
            event.preventDefault();
            $('.reply-popup').addClass('is-visible');
            $('.cd-popup').removeClass('is-visible');
            $('.forward-popup').removeClass('is-visible');
            $('.replyall-popup').removeClass('is-visible');
    });

    //close reply popup
    $('.reply-popup').on('click', function(event){
            if( $(event.target).is('.reply-popup-close') || $(event.target).is('.reply-popup') ) {
                    event.preventDefault();
                    $(this).removeClass('is-visible');
            }
    });
 
 
 //----------------------Forward mail open popup start-------------------------//    
    //open forward popup
    $('.forward-popup-trigger').on('click', function(event){
            event.preventDefault();
            $('.forward-popup').addClass('is-visible');
            $('.reply-popup').removeClass('is-visible');
            $('.cd-popup').removeClass('is-visible');
            $('.replyall-popup').removeClass('is-visible');
    });

    //close forward popup
    $('.forward-popup').on('click', function(event){
            if( $(event.target).is('.forward-popup-close') || $(event.target).is('.forward-popup') ) {
                    event.preventDefault();
                    $(this).removeClass('is-visible');
            }
    });
  
  
 //----------------------Replyall mail open popup start-------------------------//    
    //open replyall popup
    $('.replyall-popup-trigger').on('click', function(event){
            event.preventDefault();
            $('.replyall-popup').addClass('is-visible');
            $('.reply-popup').removeClass('is-visible');
            $('.cd-popup').removeClass('is-visible');
            $('.forward-popup').removeClass('is-visible');
    });

    //close replyall popup
    $('.replyall-popup').on('click', function(event){
            if( $(event.target).is('.replyall-popup-close') || $(event.target).is('.replyall-popup') ) {
                    event.preventDefault();
                    $(this).removeClass('is-visible');
            }
    });    
  
    
});