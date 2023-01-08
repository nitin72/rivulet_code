@extends('layouts.admin.app')

@section('title', 'Configurations')
@section('page_title', 'Configurations')

@section('content')
@include('layouts.admin.common.alerts')
<div class="card">
  <div class="card-header">
    <div class="card-title align-middle">  
      Post Edit
    </div>
    <div align="right">
      <a href="{{url('admin/post')}}" class="btn btn-secondary">Back</a>
    </div>
  </div>
  <!-- /.card-header -->
  <form enctype="multipart/form-data">
    <div class="card-body">
      <div class="row">
        <div class="row col-md-12">
          <div class="col-md-6">
            <input class="form-control" type="text" name="title" id="title" placeholder="Title" required maxlength="255" value="">
          </div>
          <div class="col-md-6">
            <select class="form-control" name="category" id="category" required>
              <option value="">Select Category</option>
            </select>
          </div>
          <div class="col-md-6 mt-3">
            <label>Image</label>
            <div class="row">
              <div class="col-md-6">
                <input class="form-control" id="file" type="file" name="file" required maxlength="255">
              </div>
              <div class="col-md-6" style="height: 100px; width: 100px;">
                <img src="{{url('').'/resources/assets/admin/img/default.png'}}" id="imgPreview" alt="" height="100%" width="100%">
              </div>
            </div>
          </div>
        </div>     
      </div>
      <div>
        <input class="btn btn-primary mt-2" type="submit" name="" value="Save">
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
    // setCategories();
    setData({{$id}});

    // Submit
    $('form').on('submit', function(e){
      e.preventDefault();
      var form = e.target;
      var data = new FormData(form);
      $.ajax({
        method: 'POST',
        processData: false,
        contentType: false,
        url : '{{url(config('variables.api_domain'))}}/post/update',
        data : data,
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer '+api_auth_token);
        },
        processData: false,
        async: false,
        success: function(data){
            alert('Data updated successfully.');
            window.location = '{{url('')}}/admin/post';
        },
        error: function(){
            alert('Something went wrong, please try again.');
        }
      })
    });

  }

  function setData(id='') {
    console.log(id, 222);
    $.ajax({
        type : 'GET',
        url : '{{url(config('variables.api_domain'))}}/post/'+id,
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer '+api_auth_token);
        },
        async: false,
        success: function(data){
          if (data.data[0].user_id != data.data['user']) {
            alert('Something went wrong, please try again.');
            window.location = '{{url('')}}/admin/post';
          } else {
            $('#title').val(data.data[0].title);
            setCategories(data.data[0].category_id);
            if (data.data[0].img_ext!=null) {
              $('#imgPreview').attr('src', '{{url('')}}/resources/assets/admin/img/post/'+data.data[0].id+'.'+data.data[0].img_ext);
            }
          }
        }
    });
  }

  function setCategories(selected) {
    {{-- let selected = '{{$post->category_id}}'; --}}
    $.ajax({
        type : 'GET',
        url : '{{url(config('variables.api_domain'))}}/category',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer '+api_auth_token);
        },
        async: false,
        success: function(data){
          $.each(data.data, function(i, e) {
            var option = $('<option/>').attr('value', e.id).text(e.title);
            if (e.id==selected) {
              option.prop('selected', true);
            }
            $('#category').append(option);
          });
        }
    });
  }

  // Image preview
  $('#file').change(function(){
    const file = this.files[0];
    if (file){
      let reader = new FileReader();
      reader.onload = function(event){
        $('#imgPreview').attr('src', event.target.result);
      }
      reader.readAsDataURL(file);
    }
  });
</script>
@stop