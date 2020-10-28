@extends('layout.header')

@section('content')

    <!-- /.login-logo -->
    <div class="login-box-body jumbotron" style="padding: 40px !important;">

        <!-- for validation errors -->
        @if(count($errors) > 0)
            <div id="error" class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                @foreach($errors->all() as $error)
                    <div class="msg">{{$error}}</div>
                @endforeach
            </div>
        @endif



        @if(Session::get('error_msg'))
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                {{Session::get('error_msg')}}
            </div>
        @elseif(Session::get('success_msg'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Success !</h4>
                {{Session::get('success_msg')}}
            </div>
        @endif



        <h2 class="login-box-msg text-center">REGISTRATION</h2>

        <form method="post" action="{{url('admin/register')}}">
            {{csrf_field()}}
            <div class="form-group has-feedback">
                <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{old('first_name')}}">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{old('last_name')}}">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="Email"  value="{{old('email')}}">
                
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{old('phone')}}">
                <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4 col-xs-offset-4 text-center">
                    <button type="submit" class="btn btn-success btn-block btn-flat">SUBMIT</button>
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4 col-xs-offset-4 text-center">
                    <a href="{{url('admin/login')}}" style="font-size: 25px;" title="LOGIN">CLICK HERE TO LOGIN</a>
                </div>
                <!-- /.col -->
            </div>
        </form>
        

    </div>
    <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    </body>
    </html>
@stop