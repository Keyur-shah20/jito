@extends('master')

@include('layout.sidebar')
  <!-- Main Content -->
  <main class="body-content">
    @include('layout.header_new')

    <!-- Body Content Wrapper -->
    <div class="ms-content-wrapper">
      <div class="row">
        <div class="col-md-12">
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
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-0">
              <li class="breadcrumb-item"><a href="{{url('admin/home')}}"><i class="material-icons">home</i> Home</a></li>
              <li class="breadcrumb-item" aria-current="page"><a href="{{url('admin/user')}}">User List</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add User</li>
            </ol>
          </nav>

        </div>

        <div class="col-md-12">
          <div class="ms-panel">
            <div class="ms-panel-header  ms-panel-custome">
              <h6>Add User</h6>
              <a href="{{url('admin/user')}}" class="ms-text-primary">User List</a>
            </div>
            <div class="ms-panel-body">
              
        <form method="post" action="{{url('admin/user/save')}}">
            {{csrf_field()}}
            <div class="form-group has-feedback">
                <div class="row">
                    <div class="col-sm-2">First Name:</div>
                    <div class="col-sm-6">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{old('first_name')}}">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-2">Last Name:</div>
                    <div class="col-sm-6">
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{old('last_name')}}">
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-sm-2">Email:</div>
                    <div class="col-sm-6">
                        <input type="email" name="email" class="form-control" placeholder="Email"  value="{{old('email')}}">
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-sm-2">Phone Number:</div>
                    <div class="col-sm-6">
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{old('phone')}}">
                    </div>
                </div><br>

                <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        </div>
          </div>
         </div>
      </div>
    </div>
</main>