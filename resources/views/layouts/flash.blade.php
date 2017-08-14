<script>
	function message(type, message) {
			switch(type){
				case 'info':
					toastr.info(message);
					break;
				case 'warning':
					toastr.warning(message);
					break;
				case 'success':
					toastr.success(message);
					break;
				case 'error':
					toastr.error(message);
					break;
			}
		}
	@if(Session::has('flash_level'))
		message("{{ Session::get('flash_level') }}", "{{ Session::get('flash_message') }}");
	@endif
</script>