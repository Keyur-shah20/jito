@include('layout.header')
@include('layout.user-headers')
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
<table class="table table-bordered">
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($users))
        @foreach($users as $user)
    <tr>
        <td>{{$user->first_name}}</td>
        <td>{{$user->last_name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->phone}}</td>
        <td>
           <a href="{{'edit'}}/{{$user->id}}"> <button class="btn-success">Edit</button></a>
            <a href="{{'delete'}}/{{$user->id}}">  <button class="btn-danger delete">Delete</button></a>
        </td>
    </tr>
    @endforeach
        @else
        <tr><td colspan="3">No user</td></tr>
    @endif
    </tbody>
</table>
</div>
<!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</body>

</html>