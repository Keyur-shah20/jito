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
              <li class="breadcrumb-item active" aria-current="page">Product List</li>
            </ol>
          </nav>

        </div>

        <div class="col-md-12">
          <div class="ms-panel">
            <div class="ms-panel-header  ms-panel-custome">
              <h6>Product List</h6>
              <a href="{{'products/add'}}" class="ms-text-primary">Add Product</a>
            </div>
            <div class="ms-panel-body">
              <div class="table-responsive">
                <table id="data-table5" class="table w-100 thead-primary">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Product Categories</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($products))
                        @foreach($products as $product)
                    <tr>
                        <td>{{$product->title}}</td>
                        <td>{{$product->categories}}</td>
                        <td>{{$product->image}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->status}}</td>
                        <td>
                        <a href="{{'products/edit'}}/{{$product->id}}"> <button class="btn-success">Edit</button></a>
                            <a href="{{'products/delete'}}/{{$product->id}}">  <button class="btn-danger delete">Delete</button></a>
                        </td>
                    </tr>
                    @endforeach
                        @else
                        <tr><td colspan="3">No Product found</td></tr>
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