@include('parts.header')
<div class="d-flex justify-content-center my-5">
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Criando POST</h5>
        <label for="title" class="form-label">Titulo</label>
        <input type="textfield" id="title" class="form-control">
        <label for="text" class="form-label">Texto</label>
        <input type="textfield" id="text" class="form-control">
        <div class="d-flex justify-content-end mt-2">
            <a href="#" class="btn btn-primary">Criar</a>
        </div>
    </div>
</div>
</div>
<section>
    <h1 class="h2 mb-4">
        <a class="btn btn-outline-dark btn-icon me-2" href="{{ route('blog.myposts') }}">
            <span class="ai-chevrons-left"></span>
        </a>
        Nova Publicação
    </h1>
    @if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert" id="warning">
        {!! session('warning') !!}
        <button type="button" class="btn-close" onclick="$('#warning').hide()"
            aria-label="Close"></button>
    </div>
    @endif
    @if(session('message'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert" id="success">
        {!! session('message') !!}
        <button type="button" class="btn-close" onclick="$('#success').hide()"
            aria-label="Close"></button>
    </div>
    @endif
    <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
        <div class="card-body">
            <div class="d-flex flex-column h-100 p-4">
                <div class="py-2 p-md-3">
                    <form method="post" action="{{ route('blog.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3 pb-1">
                                    <label class="form-label px-0" for="title">Título <span
                                            class="form-label px-0 ai-info" data-bs-toggle="tooltip"
                                            data-bs-placement="right"
                                            title="Escolha palavras mágicas, curiosas e chamativas. Este título aparecerá no link quando alguém enviar por alguma rede social. Tamanho máximo de 70 caracteres"></span></label>
                                    <input class="form-control" type="text" id="title" name="title" value="" maxlength="70" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3 pb-1">
                                    <label class="form-label px-0" for="subtitle">Descrição curta <span
                                            class="form-label px-0 ai-info" data-bs-toggle="tooltip"
                                            data-bs-placement="right"
                                            title="Essa descrição aparecerá no link quando alguém enviar por alguma rede social. Tamanho máximo de 155 caracteres"></span></label>
                                    <input class="form-control" type="text" id="subtitle" name="subtitle" value="" maxlength="155" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3 pb-1">
                                <label class="form-label px-0" for="category">Categoria</label>
                                <select class="form-select" name="category" id="category" required>
                                    <option value></option>

                                    <option value="OP1">OP1</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3 pb-1">
                                    <label class="form-label px-0" for="">Conteúdo</label>
                                    <div id="editor"></div>
                                    <textarea class="d-none" id="content" name="content"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3 pb-1">
                                    <label class="form-label px-0" for="imgs_url">Imagem de destaque <span class="form-label px-0 ai-info"
                                            data-bs-toggle="tooltip" data-bs-placement="right"
                                            title="Imagem que fica em destaque na postagem e aparece nos links de compartilhamentos"></span></label>
                                    <input class="form-control" type="file" name="imgs_url" id="imgs_url" accept="image/*">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3 pb-1">
                                    <label class="form-label px-0" for="account-fn">Tags - <strong>Separe por
                                            vírgulas</strong> <span class="form-label px-0 ai-info"
                                            data-bs-toggle="tooltip" data-bs-placement="right"
                                            title="Ex: saude mental,psicologia,terapia"></span></label>
                                    <input class="form-control" type="text" id="tags" name="tags" value="">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 d-flex justify-content-end pt-3">
                                    <button class="btn btn-primary ms-3" type="submit">
                                        Salvar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</section>


<script src="{{ url('js/quill/quill.min.js') }}"></script>
<script src="{{ url('js/quill/image-resize.min.js') }}"></script>
<script type="text/javascript">

    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],

        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction

        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        [ 'link', 'image', 'video', 'formula' ],          // add's image support
        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],

        ['clean']                                         // remove formatting button
    ];
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: toolbarOptions,
            imageResize: {
                displaySize: true
            }
        }
    });

    var contentInput = document.getElementById('content');

    quill.on('text-change', function(delta, oldDelta, source) {
        if (source == 'user') {
            contentInput.value = quill.root.innerHTML;
        }
    });

</script>

@include('parts.footer')
