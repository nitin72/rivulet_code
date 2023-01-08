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
      <a href="{{url('admin/category/create')}}" class="btn btn-success">Add</a>
    </div>
  </div>
  <!-- /.card-header -->
  <form id="frm_create_sales_inv" method="post" action="{{url('store')}}">
  @csrf
    <div class="card-body">
      <div class="row">
        <div class="row col-md-12">
          <table class="table" id="tbl_list">
            <thead>
              <tr>
                <th>#</th>
                <th>Title</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
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
      getData();
    }
    function getData() {
      $.ajax({
          type : 'GET',
          url : '{{url(config('variables.api_domain'))}}/category',
          beforeSend: function (xhr) {
              xhr.setRequestHeader('Authorization', 'Bearer '+api_auth_token);
          },
          async: false,
          success: function(data){
            $.each(data.data, function(i, e) {
              let tr = $('<tr/>');
              $('<td/>').html((i+1)).appendTo(tr);
              $('<td/>').html(e.title).appendTo(tr);
              // tr.append(td);
              $('#tbl_list tbody').append(tr)

            });
          }
      });
    }
</script>
@stop