@extends('layout.header')

@section('content')

    <!-- /.login-logo -->
    <div class="login-box-body">

      <a href="{{url('login')}}"> <button class="btn-primary">Login</button></a>
       <a href="{{url('register')}}"> <button class="btn-success">Register</button></a>



    </div>
    <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    </body>
    </html>
@stop