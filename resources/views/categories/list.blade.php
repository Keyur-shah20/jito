@extends('master')

@include('layout.sidebar')
  <!-- Main Content -->
  <main class="body-content">
    @include('layout.header_new')

    <!-- Body Content Wrapper -->
    <div class="ms-content-wrapper">
      <div class="row">

        <div class="col-md-12">
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
              <li class="breadcrumb-item"><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Category List</li>
            </ol>
          </nav>

        </div>

        <div class="col-md-12">
          <div class="ms-panel">
            <div class="ms-panel-header  ms-panel-custome">
              <h6>Category List</h6>
              <a href="{{'categories/add'}}" class="ms-text-primary">Add Category</a>
            </div>
            <div class="ms-panel-body">
              <div class="table-responsive">
                <table id="data-table2" class="table w-100 thead-primary">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($categories))
                        @foreach($categories as $category)
                          <tr>
                            <td>{{$category->title}}</td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->status}}</td>
                            <!-- <td>
                              <a href="{{'categories/edit'}}/{{$category->id}}"><i class="fas fa-pencil-alt ms-text-primary"></i></a>
                              <a href="{{'categories/remove'}}/{{$category->id}}">  <i class="far fa-trash-alt ms-text-danger"></i></a>
                            </td> -->
                          </tr>
                        @endforeach
                    @else
                      <tr><td colspan="4">No Category found</td></tr>
                    @endif
                    </tbody>
                </table>
              </div>
            </div>
          </div>
         </div>
      </div>
    </div>
</main>