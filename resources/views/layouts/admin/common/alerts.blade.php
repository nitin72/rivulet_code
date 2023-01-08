@if(Session('error'))
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <i class="icon fas fa-ban"></i>{{Session('error')}}
</div>
@endif
@if(Session('info'))
<div class="alert alert-info alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <i class="icon fas fa-info"></i>{{Session('info')}}
</div>
@endif
@if(Session('warning'))
<div class="alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <i class="icon fas fa-exclamation-triangle"></i>{{Session('warning')}}
</div>
@endif
@if(Session('success'))
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <i class="icon fas fa-check"></i>{{Session('success')}}
</div>
@endif

{{-- @section('scripts') --}}
	{{-- <script type="text/javascript">
		$(".alert").delay(3000).fadeOut(3000);
	</script> --}}
{{-- @stop --}}