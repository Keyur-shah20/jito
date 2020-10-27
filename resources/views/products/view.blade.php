@include('layout.header')
@include('layout.user-headers')

    <div class="page-header">
        <h1>
            <small>
                <a href="/products">View</a>
            </small>
        </h1>
    </div>

    @if ($product->title)
        <div class="page-header">
            <h1>{{ $product->title }}</h1>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="{{ DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $product->picture . '.jpg' }}" alt="Tamanho padrão">
                    <div class="caption">
                        <h3>Imagem do produto</h3>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    <label for="">Vantagens</label>
                    {{ $product->advantages_br }}
                </div>
                <div class="form-group">
                    <label for="">Características</label>
                    {{ $product->characteristics_br }}
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="{{ DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $product->packing_br . '.jpg' }}" alt="Tamanho padrão">
                    <div class="caption">
                        <h3>Embalagem</h3>
                    </div>
                </div>
            </div>
        </div>
    @endif