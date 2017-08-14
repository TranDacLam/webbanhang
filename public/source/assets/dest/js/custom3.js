$(document).ready(function() {
	$.ajaxSetup({
	    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
	  });

	$(".result_msg, .error_msg").delay(3000).slideUp();

	$('.add-to-cart').click(function(e){
        e.preventDefault();
        product_id = $(this).attr('data-product-id');
        quantilyDetail = $('#quantilyDetaiPro-' + product_id).val();
        if(quantilyDetail == null){
        	quantily = 1;
        }else{
        	quantily = quantilyDetail;
        }
        $.ajax({
           	url: 'add-to-cart/' + product_id,
        	type: 'get',
        	data: { quantily: quantily },
        	dataType: 'json'
        })
        .done(function(response) {
        	if(response.status){
        		toastr.success('Thêm sản phẩm vào giỏ hàng thành công');
	      		$('.totalQtyCart').text(response.totalQty);
        	}else{
            $('#quantilyDetaiPro-' + product_id).val(1);
        		toastr.error('Số lượng yêu cầu > 0');
        	}
      	})
      	.fail(function() {
        	toastr.error('Lỗi. Xin vui lòng reload lại trang');
      	})
  	});

  	$('.change-qty-cart').change(function(e){
        e.preventDefault();
        var formatter = new Intl.NumberFormat('en-US', {
  	      currency: 'VND',
  	      minimumFractionDigits: 0, /* this might not be necessary */
  	    });
        product_id = $(this).attr('data-product-id');
        quantily_cart = $('#qty-cart-' + product_id).val();
        $.ajax({
           	url: 'add-to-cart/' + product_id,
        	type: 'get',
        	data: { quantily_cart: quantily_cart },
        	dataType: 'json'
        })
        .done(function(response) {
	        if(response.status){
        		toastr.success('Cập nhập giỏ hàng thành công');
	      		$('.totalQtyCart').text(response.totalQty);
	      		$('.totalPriceCart').text(formatter.format(response.totalPrice) + " vnđ");
	      		$('#subTotalCart-' + product_id).text(formatter.format(response.subtotal));
        	}else{
            $('#qty-cart-' + product_id).val(response.subTotalQty);
        		toastr.error('Số lượng yêu cầu > 0');
        	}
      	})
      	.fail(function() {
        	toastr.error('Lỗi. Xin vui lòng reload lại trang');
      	})
  	});

    $('.remove-cart').click(function(e){
      if (confirm('Bạn đồng ý xóa không?')) {
        e.preventDefault();
        var formatter = new Intl.NumberFormat('en-US', {
          currency: 'VND',
          minimumFractionDigits: 0, /* this might not be necessary */
        });
        product_id = $(this).attr('data-product-id');
        $.ajax({
            url: 'del-cart/' + product_id,
          type: 'get',
          dataType: 'json'
        })
        .done(function(response) {
          if(response.status){
            toastr.success('Xóa sản phẩm trong giỏ hàng thành công');
            $('.totalQtyCart').text(response.totalQty);
            $('.totalPriceCart').text(formatter.format(response.totalPrice) + " vnđ");
            $('#del-cart-' + product_id).remove();
          }else{
            location.reload();
            toastr.info('Giỏ hàng trống');
          }
        })
        .fail(function() {
          toastr.error('Lỗi. Xin vui lòng reload lại trang');
        })
      }else{
        return false;
      }
    });

    $(document).on('click', '.suggest', function(e){
      e.preventDefault();
      toastr.info('Đang cập nhập...');
    });
});

function confirmDel(msg){
	if(window.confirm(msg)){
		return true;
	}
	return false;
}