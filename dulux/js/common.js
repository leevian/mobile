$(function(){
    $('.pop-overlay .close-btn').bind('touchend',function(e){
  
        $(this).parents('.pop-overlay').css('z-index','1');
        return false;
    })
})