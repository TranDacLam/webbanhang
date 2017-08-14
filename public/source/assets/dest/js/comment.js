$(document).ready(function() {
	$.ajaxSetup({
	    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
	  });

	$('.add-comment').click(function(e){
    e.preventDefault();
    product_id = $('input[name=p_id]').val();
    cotnent = $('input[name=content]').val();
    $.ajax({
      url: 'binh-luan',
    	type: 'post',
    	data: { 
            product_id : product_id,
            cotnent : cotnent,
            '_token': $('meta[name="_token"]').attr('content')
          },
    	dataType: 'json'
    })
    .done(function(response) {
    	$('input[name=content]').val('');
      $('#comment-parent-' + product_id).prepend('<li class="comment" id="del-comment-'+ response.id +'">'
                                      + '<span class="pull-left">'
                                      + '<img class="avatar" src="http://bootdey.com/img/Content/user_1.jpg" '
                                      + 'alt="avatar">'
                                      + '</span>'
                                      + '<div class="comment-body">'
                                      + '<div class="comment-heading">'
                                      + '<h4 class="user">'+ response.full_name +'</h4>'
                                      + '<h5 class="time">'+ response.create_at +' <a href="#" class="del-comment" '
                                      + 'title="xóa" data-cmt-id="'+ response.id +'">'
                                      + '<i class="fa fa-trash-o"></i></a>'
                                      + '<a href="#" class="edit-comment" ' 
                                      + 'title="chỉnh sửa" data-cmt-id="'+ response.id +'">'
                                      + '<i class="fa fa-pencil-square-o"></i></a>'
                                      + '</h5></div>'
                                      + '<p><span id="edit-comment-'+ response.id +'">'+ response.content +'</span></p>'
                                      + '<p class="text-right">'
                                      + '<a href="#reply'+ response.id +'" class="btn btn-default btn-sm reply-cmt"'
                                      + 'data-comment-id='+ response.id +'" data-toggle="collapse">'
                                      + '<i class="fa fa-reply"></i>reply</a> </p>'
                                      + '</div> <ul class="comments-list collapse" id="reply'+ response.id +'">'
                                      + '<div class="input-group"> '
                                      + '<input placeholder="Trả lời..." class="form-control"'
                                      + 'name="content_reply" type="text" id="content-reply-'+ response.id +'" required/>'
                                      + '<span class="input-group-addon">'
                                      + '<a class="btn btn-default btn-sm add-comment_reply" style="line-height: 1"'
                                      + 'data-p-id="'+ product_id +'" data-parent-id="'+ response.id +'" '
                                      + '>Trả lời</a> </span></div>'
                                      + '</ul></li>' );
  	})
  	.fail(function() {
    	toastr.error('Lỗi. Xin vui lòng reload lại trang');
  	})
  });

  $(document).on('click', '.add-comment_reply', function(e){
    e.preventDefault();
    product_id = $(this).attr('data-p-id');
    parent_id = $(this).attr('data-parent-id');
    content = $('#content-reply-'+ parent_id).val();
    count_reply = parseInt($('#count-reply-' + parent_id).text());
    $.ajax({
      url: 'tra-loi-binh-luan',
      type: 'post',
      data: { 
            product_id : product_id,
            parent_id : parent_id,
            content : content,
            '_token': $('meta[name="_token"]').attr('content')
          },
      dataType: 'json'
    })
    .done(function(response) {
      $('input[name=content_reply]').val('');
      $('#reply' + parent_id).prepend('<li class="comment" id="del-reply-'+ response.id +'">'
                                      + '<span class="pull-left">'
                                      + '<img class="avatar" src="http://bootdey.com/img/Content/user_1.jpg" '
                                      + 'alt="avatar">'
                                      + '</span>'
                                      + '<div class="comment-body">'
                                      + '<div class="comment-heading">'
                                      + '<h4 class="user">'+ response.full_name +'</h4>'
                                      + '<h5 class="time">'+ response.create_at +' <a href="#" '
                                      + 'class="del-comment-reply" title="xóa" data-cmt-id="'+ response.id +'"'
                                      + ' data-cmt-parent="'+ parent_id +'" >'
                                      + '<i class="fa fa-trash-o"></i></a></h5>'
                                      + '</div>'
                                      + '<p>'+ content +'</p>'
                                      + '<p class="text-right">'
                                      + '</div> </li>' );
      count_reply += 1;
      $('#count-reply-' + parent_id).text(count_reply);
    })
    .fail(function() {
      toastr.error('Lỗi. Xin vui lòng reload lại trang');
    })
  });

  $(document).on('click', '.del-comment', function(e){
    if (confirm('Bạn đồng ý xóa không?')) {
      e.preventDefault();
      comment_id = $(this).attr('data-cmt-id');
      $.ajax({
        url: 'del-binh-luan/' + comment_id,
        type: 'get',
        dataType: 'json'
      })
      .done(function() {
        $('#del-comment-' + comment_id).remove();
      })
      .fail(function() {
        toastr.error('Lỗi. Xin vui lòng reload lại trang');
      })
    }else{
      return false;
    }
  });

  $(document).on('click', '.del-comment-reply', function(e){
    if (confirm('Bạn đồng ý xóa không?')) {
      e.preventDefault();
      comment_id = $(this).attr('data-cmt-id');
      comment_parent = $(this).attr('data-cmt-parent');
      count_reply = parseInt($('#count-reply-' + comment_parent).text());
      $.ajax({
        url: 'del-binh-luan/' + comment_id,
        type: 'get',
        dataType: 'json'
      })
      .done(function() {
        $('#del-reply-' + comment_id).remove();
        count_reply -= 1;
        $('#count-reply-' + comment_parent).text(count_reply);
      })
      .fail(function() {
        toastr.error('Lỗi. Xin vui lòng reload lại trang');
      })
    }else{
      return false;
    }
  });

  $(document).on('click', '.edit-comment', function(e){
    e.preventDefault();
    comment_id = $(this).attr('data-cmt-id');
    content = $('#edit-comment-' + comment_id).text();
    $('#edit-comment-' + comment_id).html('<div class="input-group"> '
                                      + '<input class="form-control" id="update-comment-'+ comment_id +'"'
                                      + 'value="'+ content +'"'
                                      + 'name="content_reply" type="text" required/>'
                                      + '<span class="input-group-addon">'
                                      + '<a class="btn btn-default btn-sm update-comment" style="line-height: 1"'
                                      + 'data-parent-id="'+ comment_id +'" '
                                      + '>Cập nhập</a> </span></div>');
    $('.comment-hide').hide();
  });

  $(document).on('click', '.update-comment', function(e){
    e.preventDefault();
    comment_id = $(this).attr('data-parent-id');
    content = $('#update-comment-'+ comment_id).val();
    $.ajax({
      url: 'cap-nhap-binh-luan/' + comment_id,
      type: 'get',
      data: {content : content},
      dataType: 'json'
    })
    .done(function() {
      $('#edit-comment-' + comment_id).text(content);
      $('.comment-hide').show();
    })
    .fail(function() {
      toastr.error('Lỗi. Xin vui lòng reload lại trang');
    })
  });
});