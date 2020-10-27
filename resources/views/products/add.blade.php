@include('layout.header')
@include('layout.user-headers')

    <div class="page-header">
        <h1>Add Product</h1>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form class="form-horizontal"  action="/products/save" method="post" enctype="multipart/form-data">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="marketed">Categories</label>
            <select name="categories" id="categories" class="form-control">
                @foreach($categories as $key => $value)
                    <option value="{{ $value->id }}">{{ $value->title }}</option>
                @endforeach
            </select>
        </div>

        
        <div class="tab-content">
            <div id="br" class="tab-pane fade in active">
                <div class="form-group">
                    <div class="col-lg-6">
                        <label for="name_br">Name</label>
                        <input type="text" name="name_br" id="name_br" value="{{ old('name_br') }}" class="form-control">
                    </div>
                    <div class="col-lg-6">
                        <label for="image_br">Image</label>
                        <input type="file" name="image_br" id="image_br" class="form-control">
                    </div>
                </div>

            </div>
            
        </div>


        <input type="submit" class="btn btn-primary" value="Save">
        <a class="btn btn-danger" href="/products">Cancel</a>

    </form>