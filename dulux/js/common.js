$(function(){
    $('.pop-overlay .close-btn a').bind('touchend',function(e){
        e.stopPropagation();
        $(this).parents('.pop-overlay').css('z-index','1');
        return false;
    })
})