@extends('layouts.admin.app')
@section('content')
@include('layouts.admin.common.alerts')
<div class="card">
  <div class="card-header">
    <div class="card-title align-middle">  
      Post
    </div>
    <div align="right">
      <a href="{{url('admin/post/create')}}" class="btn btn-success">Add</a>
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
                <th>Image</th>
                <th>Comments Count</th>
                <th>Action</th>
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
          url : '{{url(config('variables.api_domain'))}}/post',
          beforeSend: function (xhr) {
              xhr.setRequestHeader('Authorization', 'Bearer '+api_auth_token);
          },
          async: false,
          success: function(data){
            let image_base = '{{url('')}}/resources/assets/admin/img';
            let default_image = image_base+'/default.png';
            $.each(data.data['posts'], function(i, e) {
              let tr = $('<tr/>');
              // id
              $('<td/>').html((i+1)).appendTo(tr);
              // img
              let img = $('<img/>');
              if (e.img_ext==null) {
                img.attr('src', default_image);
              }
              else {
                img.attr('src', image_base+'/post/'+e.id+'.'+e.img_ext);
              }
              img.css('width', '50px');
              $('<td/>').html(img).appendTo(tr);
              // title
              $('<td/>').html(e.title).appendTo(tr);
              // Commetns count
              $('<td/>').html(e.comments.length).appendTo(tr);
              // action
              if (data.data['user']==e.user_id) {
                var edit = $('<a/>').html($('<i/>').attr('class', 'fas fa-edit')).attr('href', '{{url('')}}/admin/post/edit/'+e.id);
              } else {
                var edit = '';
              }
              var view = $('<a/>').html($('<i/>').attr('class', 'fas fa-eye')).attr('href', '{{url('')}}/admin/post/view/'+e.id);
              let action = $('<td/>');
              action.append(edit);
              action.append(view);
              action.appendTo(tr);
              // action.html(edit).appendTo(tr);
              $('#tbl_list tbody').append(tr)

            });
          }
      });

    }
</script>
@stop