@include('layout.header')
@include('layout.user-headers')

    <div class="page-header">
        <h1>
            {{ $category->name_br }} | {{ $category->name_en }} | {{ $category->name_es }}
            <small>
                <a href="/categories">View</a>
            </small>
        </h1>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="{{ DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $category->image_br . '.jpg' }}" alt="Tamanho padrão">
                <div class="caption">
                    <h3>Tamanho padrão - Português</h3>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="{{ DIRECTORY_SEPARATOR . 'thumbs' . DIRECTORY_SEPARATOR . $category->image_br . '_50.jpg' }}" alt="Tamanho 50%">
                <div class="caption">
                    <h3>Tamanho 50% - Português</h3>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="{{ DIRECTORY_SEPARATOR . 'thumbs' . DIRECTORY_SEPARATOR . $category->image_br . '_30.jpg' }}" alt="Tamanho 30%">
                <div class="caption">
                    <h3>Tamanho 30% - Português</h3>
                </div>
            </div>
        </div>
    </div>