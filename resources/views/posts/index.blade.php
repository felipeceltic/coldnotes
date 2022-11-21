<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ColdNotes') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    @livewireStyles

    <!-- Scripts -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

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
        <h3>Sua(s) Nota(s)!</h3>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 mx-4 px-5">
        @foreach ($posts as $p)
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $p->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $p->subtitle }}</h6>
                        <p class="card-text">{{ $p->content }}</p>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('post.edit', $p->id) }}"
                                class="btn btn-secondary mx-3">Editar</a>
                            <form method="POST" action="{{ route('posts.destroy', $p->id) }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger delete" title='Delete'>Excluir</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            @php
                                setlocale(LC_ALL, NULL);
                                setlocale(LC_ALL, 'pt_BR');
                                $d1 = strtotime($p->updated_at);
                                echo strftime('Atualizado em '.'%d'.' de '.'%B'.' de '.'%Y', $d1);
                            @endphp
                        </small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>

@push('script')

<script type="text/javascript">
    $(document).ready(function() {
        $('.delete').click(function(e) {
            if(!confirm('Tem certeza de que deseja excluir?')) {
                e.preventDefault();
            }
        });
    });
</script>

@endpush
