@extends('layouts.admin.app')

@section('title', 'Configurations')
@section('page_title', 'Configurations')

@section('content')
@include('layouts.admin.common.alerts')
<div class="card">
  <div class="card-header">
    <div class="card-title align-middle">  
      Category
    </div>
    <div align="right">
      <a href="{{url('admin/category')}}" class="btn btn-secondary">Back</a>
    </div>
  </div>
  <!-- /.card-header -->
  <form id="frm_create_sales_inv" method="post" action="{{url('store')}}">
    <div class="card-body">
      <div class="row">
        <div class="row col-md-12">
          <div class="col-md-12">
            <input class="form-control" type="text" name="title" required maxlength="100">
            <input class="btn btn-primary mt-2" type="submit" name="" value="Add">
          </div>
        </div>     
      </div>
    </div>

  </form>

  <!-- /.card-body -->
</div>
@stop

@section('scripts')
<script type="text/javascript" charset="utf-8" async defer>
    const api_auth_token = window.localStorage.getItem('api_auth_token');
    if (api_auth_token!=null) {
      $('form').submit(function() {
          $.ajax({
              type : 'POST',
              url : '{{url(config('variables.api_domain'))}}/category/store',
              data : $('form').serialize(),
              beforeSend: function (xhr) {
                  xhr.setRequestHeader('Authorization', 'Bearer '+api_auth_token);
              },
              async: false,
              success: function(data){
                  alert('Data created successfully.');
                  window.location = '{{url('')}}/admin/category';
              },
              error: function(){
                  alert('Something went wrong, please try again.');
              },
          });
          return false;
      });
    }
</script>
@stop