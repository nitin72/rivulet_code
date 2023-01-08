@extends('auth.app')

@section('content')
    <form>
        <div class="container login-container">
            <div class="" align="center">
                <div class="col-md-6 login-form-1">
                    <h3>Login for Form 1</h3>
                        <div class="form-group">
                            <input type="text" name='name' class="form-control" placeholder="Your Name *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="email" name='email' class="form-control" placeholder="Your Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Your Password *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Register" />
                        </div>
                        <div class="form-group">
                            <a href="{{url('')}}/login" title="">Login</a>
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
                url : '{{url(config('variables.api_domain'))}}/register',
                data : $('form').serialize(),
                async: false,
                success: function(data){
                    if (typeof data.token!= 'undefined') {
                        window.location = '{{url('')}}/login';
                    }
                }
            });
            return false;
        });
    </script>
@stop