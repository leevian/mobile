function cartAdd(price){
	// alert($('.footer .img-box span').html())

	var cartNum = parseInt($('.footer .img-box span').html())+1;
	$('.footer .img-box span').removeClass('hide').html(cartNum);
	var cartPrice = parseFloat($('.footer .price-box span').html())+parseFloat(price);

	$('.footer .price-box span').html(cartPrice.toFixed(2))

}
function cartMinus(price){
	// alert($('.footer .img-box span').html())
	var cartNum = parseInt($('.footer .img-box span').html())-1;
	if(cartNum<=0){
		cartNum=0;
		$('.footer .img-box span').addClass('hide');

	}
	$('.footer .img-box span').html(cartNum);
	var cartPrice = parseFloat($('.footer .price-box span').html())-parseFloat(price);
	$('.footer .price-box span').html(cartPrice.toFixed(2))
}