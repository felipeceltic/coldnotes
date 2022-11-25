<body class="font-sans antialiased">
    <!-- Page Heading -->
    <div>
        @livewire('navigation-menu')

        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

    </div>
    <!-- Page Content -->
    <div class="d-flex justify-content-center mt-5">
        <h3>Crie sua Nota!</h3>
    </div>
    <div class="d-flex justify-content-center">
        <form method="POST" action="{{ route('post.store') }}">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titulo</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="subtitle" class="form-label">Subtitulo</label>
                <input type="text" class="form-control" id="subtitle" name="subtitle">
            </div>
            <div class="mb-3">
                <label for="content">Área de texto</label>
                <textarea class="form-control" name="content" id="content"  style="height: 100px"></textarea>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Criar Nota</button>
            </div>
        </form>
    </div>

    @stack('modals')

    @livewireScripts
</body>
@include("parts.footer")
</html>
