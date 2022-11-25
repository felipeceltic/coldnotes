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
    @auth
        <div class="d-flex justify-content-center mt-4">
            <form action="{{ route('post.search') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Buscar" aria-label="Buscar"
                        aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar</button>
                </div>
            </form>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 mx-4 px-5">
            @foreach ($posts as $p)
                @if ($p->user_id == Auth::user()->id)
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $p->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $p->subtitle }}</h6>
                                <p class="card-text">{{ $p->content }}</p>
                                <a href="{{ route('post.restore', $p->id) }}"
                                    class="btn btn-outline-success w-100 mt-2">Restaurar</a>
                                <form id="hardform" method="POST" action="{{ route('post.hard.destroy', $p->id) }}">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                </form>
                                <button type="submit" class="btn btn-danger w-100" id="hard.destroy">Excluir
                                    permanentemente</button>
                            </div>
                            <div class="card-footer">
                                <p class="text-muted text-end lh-1" style="font-size: 0.9rem">
                                    @php
                                        setlocale(LC_ALL, null);
                                        setlocale(LC_ALL, 'pt_BR');
                                        $d1 = strtotime($p->updated_at);
                                        echo strftime('Atualizado em ' . '%d' . ' de ' . '%B' . ' de ' . '%Y', $d1);
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="d-flex justify-content-center py-3">
            @if (isset($filter))
                {{ $posts->appends($filter)->links('parts.paginate') }}
            @else
                {{ $posts->links('parts.paginate') }}
            @endif
        </div>
    @endauth
    @guest
        <div class="container my-5">
            <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
                <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                    <h1 class="display-4 fw-bold lh-1">Crie sua conta para organizar suas notas!</h1>
                    <p class="lead">Um novo e frio espaço pra você congelar suas ideias rapidamente!</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                        <a href="{{ route('register') }}" type="button"
                            class="btn btn-primary btn-lg px-4 me-md-2 fw-bold">CADASTRE-SE!</a>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden">
                    <img class="rounded-lg-3" src="./android-chrome-512x512.png" alt="Logo" width="720">
                </div>
            </div>
        </div>
    @endguest
    @stack('modals')

    @livewireScripts
</body>
@include("parts.footer")

<script type="text/javascript">

    const hardButton = document.getElementById('hard.destroy');

    function submitForm() {
        const form = document.getElementById("hardform");
        form.submit();
    }

    hardButton.addEventListener('click', () => {

        const resultado = confirm('Tem certeza de que deseja excluir a nota permanentemente?');
        if (resultado == true) {
            submitForm();
        }
    });

</script>

</html>
