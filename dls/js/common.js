$(function(){
    $('.pop-overlay .close-js a').bind('touchend',function(e){
        e.stopPropagation();
        $(this).parents('.pop-overlay').hide();
        return false;
    })
})