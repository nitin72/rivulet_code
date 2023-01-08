@extends('auth.app')

@section('content')
    <form>
        <div class="container login-container">
            <div class="" align="center">
                <div class="col-md-6 login-form-1">
                    <h3>Login for Form 1</h3>
                        <div class="form-group">
                            <input type="email" name='email' class="form-control" placeholder="Your Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Your Password *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Login" />
                        </div>
                        <div class="form-group">
                            <a href="{{url('')}}/register" title="">Register</a>
                        </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('scripts')
    <script type="text/javascript" charset="utf-8" async defer>
        $('form').submit(function() {
            $.ajax({
                type : 'POST',
                url : '{{url(config('variables.api_domain'))}}/login',
                data : $('form').serialize(),
                async: false,
                success: function(data){
                    // console.log(data);return false;
                    if (typeof data.token!= 'undefined') {
                        window.localStorage.setItem('api_auth_token', data.token);
                        window.location = '{{url('')}}/admin/dashboard';
                    }
                },
                error: function(error){
                    alert('Please enter valid credentials.');
                } 
            });
            return false;
        });
    </script>
@stop