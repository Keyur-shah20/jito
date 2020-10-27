@include('layout.header')
@include('layout.user-headers')

    <div class="page-header">
        <h1>Edit Categories</h1>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="form-horizontal"  action="/categories/update" method="post" enctype="multipart/form-data">

        {{ csrf_field() }}

        <input type="hidden" name="id" id="id" value="{{ $categoria->id }}">

        <div class="form-group">
            <div class="col-lg-6">
                <label for="name_br">Name</label>
                <input value="{{ $categoria->name_br }}" type="text" name="name_br" id="name_br" class="form-control">
            </div>
            <div class="col-lg-6">
                <label for="image_br">Image</label>
                <input type="file" name="image_br">
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Save">
        <a class="btn btn-danger" href="/categories">Back</a>

    </form>