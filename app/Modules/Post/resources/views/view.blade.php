@extends('layouts.admin.app')

@section('title', 'Configurations')
@section('page_title', 'Configurations')

@section('content')
@include('layouts.admin.common.alerts')
<div class="card">
  <div class="card-header">
    <div class="card-title align-middle">  
      Post View
    </div>
    <div align="right">
      <a href="{{url('admin/post')}}" class="btn btn-secondary">Back</a>
    </div>
  </div>
  <!-- /.card-header -->
  {{-- <form enctype="multipart/form-data"> --}}
    <div class="card-body">
      <div class="row">
        <div class="row col-md-12">
          <div class="col-md-6">
            <span class="font-weight-bold" id="title"></span> - (<span id="category"></span>)
          </div>
          <div class="col-md-6 mt-3">
            <div class="row">
              <div class="col-md-6" style="height: 100px; width: 100px;">
                <img src="{{url('').'/resources/assets/admin/img/default.png'}}" id="imgPreview" alt="" height="100%" width="100%">
              </div>
            </div>
          </div>
        </div> 

        <div class="row col-md-12 mt-4">
          <div class="card col-12">
            <div class="card-header">
              <div class="card-title align-middle">  
                Comments
              </div>
            </div>
          </div>
          <div class="col-md-6 mt-3">
            <form>
              <div class="row">
                <div class="col-md-12 row">
                    <div class="col-md-10">
                      <textarea name="comment" id="comment" class="form-control" placeholder="Write you comment here.." required></textarea>
                    </div>
                    <div class="col-md-2">
                      <input class="btn btn-primary" type="submit" name="" value="Save">
                    </div>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-md-12">
                Total - <span id="total_comment_count"></span>
              </div>
              <div class="col-md-12 row" id="comments_container">
              </div>
            </div>
          </div>
        </div>     
      </div>
      <div>
      </div>
    </div>

  {{-- </form> --}}

  <!-- /.card-body -->
</div>
@stop

@section('scripts')
<script type="text/javascript" charset="utf-8" async defer>
  const api_auth_token = window.localStorage.getItem('api_auth_token');
  const post = "{{$id}}";
  if (api_auth_token!=null) {
    // setCategories();
    setData({{$id}});

    // Submit
    $('form').submit(function() {
        $.ajax({
            type : 'POST',
            url : '{{url(config('variables.api_domain'))}}/post/comment/store/'+{{$id}},
            data : $('form').serialize(),
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer '+api_auth_token);
            },
            async: false,
            success: function(data){
              setComments(post);
              $('#comment').val('');
            },
            error: function(){
                alert('Something went wrong, please try again.');
            },
        });
        return false;
    });

  }

  function setData(id='') {
    $.ajax({
        type : 'GET',
        url : '{{url(config('variables.api_domain'))}}/post/'+id,
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer '+api_auth_token);
        },
        async: false,
        success: function(data){
          $('#title').text(data.data[0].title);
          setCategories(data.data[0].category_id);
          if (data.data[0].img_ext!=null) {
            $('#imgPreview').attr('src', '{{url('')}}/resources/assets/admin/img/post/'+data.data[0].id+'.'+data.data[0].img_ext);
          }
          // Comments
          setComments(post);
        }
    });
  }

  function setComments(post) {
    $.ajax({
        type : 'GET',
        url : '{{url(config('variables.api_domain'))}}/post/comment/'+post,
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer '+api_auth_token);
        },
        async: false,
        success: function(data){
          let comments = $('<ul>');
          $.each(data.data['comments'], function(i, e) {
            $('<li/>').text(e.description+' - '+e.name).appendTo(comments);
          });
          $('#comments_container').html(comments);
          $('#total_comment_count').text(data.data['count']);
        }
    });
  }

  function setCategories(selected) {
    $.ajax({
        type : 'GET',
        url : '{{url(config('variables.api_domain'))}}/category',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer '+api_auth_token);
        },
        async: false,
        success: function(data){
          $.each(data.data, function(i, e) {
            if (e.id==selected) {
              $('#category').text(e.title);
            }
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