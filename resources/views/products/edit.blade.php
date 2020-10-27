@include('layout.header')
@include('layout.user-headers')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="form-horizontal"  action="/products/update" method="post" enctype="multipart/form-data">

        {{ csrf_field() }}

        <input type="hidden" name="id" id="id" value="{{ $product->id }}">

        <div class="form-group">
            <label for="marketed">Categories</label>
            <select name="categories" id="categories" class="form-control">
                @foreach($categories as $key => $value)
                    <option value="{{ $value->id }}" {{ $value->id == $product->categories ? 'selected' : '' }}>{{ $value->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="marketed">Vendido em</label>
            <select name="marketed" id="marketed" class="form-control">
                <option value="3" {{ $product->marketed == 3 ? 'selected' : '' }}>Todos</option>
                <option value="1" {{ $product->marketed == 1 ? 'selected' : '' }}>Brasil</option>
                <option value="2" {{ $product->marketed == 2 ? 'selected' : '' }}>Estados Unidos</option>
            </select>
        </div>

        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#br">Português</a>
            </li>
            <li>
                <a data-toggle="tab" href="#en">Inglês</a>
            </li>
            <li>
                <a data-toggle="tab" href="#es">Espanhol</a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="br" class="tab-pane fade in active">
                <div class="form-group">
                    <div class="col-lg-6">
                        <label for="name_br">Nome</label>
                        <input type="text" name="name_br" id="name_br" value="{{ $product->name_br }}" class="form-control">
                    </div>
                    <div class="col-lg-6">
                        <label for="image_br">Imagem</label>
                        <input type="file" name="image_br" id="image_br" class="form-control" value="{{ $product->image_br }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-6">
                        <label for="advantages_br">Vantagens</label>
                        <input type="text" name="advantages_br" id="advantages_br" value="{{ $product->advantages_br }}" class="form-control">
                    </div>
                    <div class="col-lg-6">
                        <label for="characteristics_br">Características</label>
                        <input type="text" name="characteristics_br" id="characteristics_br" value="{{ $product->characteristics_br }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-6">
                        <label for="packing_br">Embalagem</label>
                        <input type="file" name="packing_br" id="packing_br" class="form-control" value="{{ $product->packing_br }}">
                    </div>
                </div>
            </div>
        </div>


        <input type="submit" class="btn btn-primary" value="Save">
        <a class="btn btn-danger" href="/products">Back</a>

    </form>