$(document).ready(function() {
	$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
  });

	$(".result_msg, .error_msg").delay(3000).slideUp();
	$(".flash_success, .flash_error").delay(3000).slideUp();

	$('.del-cate').click(function(e){
    if (confirm('Bạn đồng ý xóa không?')) {
      e.preventDefault();
      cate_id = $(this).attr('data-cateid');
      $.ajax({
         	url: 'admin/the-loai/del/' + cate_id,
      	type: 'get',
      	dataType: 'json'
      })
      .done(function(response) {
      	if (response.status) {
          toastr.success('Xóa thể loại thành công');
        	$('#del-cate-' + cate_id).remove();
      	}else{
        	toastr.warning("Xóa thể loại thất bại");
      	}
    	})
    	.fail(function() {
      	toastr.error('Lỗi. Xin vui lòng reload lại trang');
    	})
    }
  	});

});

function confirmDel(msg){
	if(window.confirm(msg)){
		return true;
	}
	return false;
}