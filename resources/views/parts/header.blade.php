<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ColdNotes') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <script src="https://kit.fontawesome.com/f721c01546.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- Styles -->
    @livewireStyles
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
        integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</head>
<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-between mb-md-0">
                <img src="./mstile-144x144.png" alt="Logo" width="32" height="32">
                @auth
                    <a class="btn btn-outline-primary ms-3" href="{{ route('post.index') }}">Inicio</a>
                    <a class="btn btn-outline-primary ms-3" href="{{ route('post.deletedindex') }}">Deletadas</a>
                    <a class="btn btn-outline-primary mx-3" href="{{ route('post.create') }}" role="button">Criar Post</a>
                @endauth
            </ul>
            @if (Route::has('login'))

                @auth
                    <a class="btn btn-success me-3" data-bs-toggle="modal" data-bs-target="#modalDoe"><i
                            class="bi bi-balloon-heart"></i> Ajude o Projeto!</a>
                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                            {{ Auth::user()->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>
                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Gerenciar conta') }}
                                </div>

                                <x-jet-dropdown-link class="text-decoration-none" href="{{ route('profile.show') }}">
                                    {{ __('Meu Perfil') }}
                                </x-jet-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-jet-dropdown-link>
                                @endif

                                <div class="border-t border-gray-100"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-jet-dropdown-link class="text-decoration-none" href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                                        {{ __('Sair') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @else
                    {{-- <a class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#modalSignin">Entrar</a>
                    @if (Route::has('register'))
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegister">Cadastar</a>
                    @endif --}}
                    <a class="btn btn-primary me-3" href="{{ route('login') }}">Entrar</a>
                    <a class="btn btn-primary me-3" href="{{ route('register') }}">Cadastrar</a>
                @endauth
            @endif
        </div>
        <!-- MODAL Doe -->
        <div class="modal modal-signin py-5" tabindex="-1" role="dialog" id="modalDoe" aria-hidden="true"
            style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h1 class="fw-bold mb-0 fs-2 text-dark">Doe!<i class="bi bi-balloon-heart-fill"></i></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center px-5">
                            <p class="h5 text-dark text-center mb-n4">Ajude a mantenedor do projeto doando qualquer valor.</p>
                        </div>
                        <div class="d-flex justify-content-center px-5">
                            <p class="text-dark text-center text-muted mb-n4">todo valor arrecadado será investido nos custos de
                                hospedagem e manutenção do serviço</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <img class="rounded-4" src="./pix.svg" alt="" width="256" height="256">
                        </div>
                        <div class="d-flex justify-content-center mb-4">
                            <input type="text" name="textpix" id="textpix"
                            value="00020101021126460014br.gov.bcb.pix0124felipeceltic@outlook.com5204000053039865802BR5918LUIZ F DA S ARAUJO6008IGARASSU62070503***63045EA3"
                            hidden>
                            <button class="btn btn-success" id="copypix">PIX copia e cola</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL CADASTRO -->
        <div class="modal modal-signin py-5" tabindex="-1" role="dialog" id="modalRegister" aria-hidden="true"
            style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header p-5 pb-4 border-bottom-0">
                        <h1 class="fw-bold mb-0 fs-2 text-dark">Cadastre-se</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-5 pt-0">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div>
                                <x-jet-label for="name" value="{{ __('Nome') }}" />
                                <x-jet-input id="name" class="text-dark block mt-1 w-full" type="text"
                                    name="name" :value="old('name')" required autofocus autocomplete="name" />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="email" value="{{ __('Email') }}" />
                                <x-jet-input id="email" class="text-dark block mt-1 w-full" type="email"
                                    name="email" :value="old('email')" required />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password" value="{{ __('Senha') }}" />
                                <x-jet-input id="password" class="text-dark block mt-1 w-full" type="password"
                                    name="password" required autocomplete="new-password" />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password_confirmation" value="{{ __('Confirmar Senha') }}" />
                                <x-jet-input id="password_confirmation" class="text-dark block mt-1 w-full"
                                    type="password" name="password_confirmation" required
                                    autocomplete="new-password" />
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-jet-label for="terms">
                                        <div class="flex items-center">
                                            <x-jet-checkbox name="terms" id="terms" />

                                            <div class="ml-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                    'terms_of_service' =>
                                                        '<a target="_blank" href="' .
                                                        route('terms.show') .
                                                        '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                                        __('Terms of Service') .
                                                        '</a>',
                                                    'privacy_policy' =>
                                                        '<a target="_blank" href="' .
                                                        route('policy.show') .
                                                        '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                                        __('Privacy Policy') .
                                                        '</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-jet-label>
                                </div>
                            @endif

                            <div class="flex items-center justify-end mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                    href="{{ route('login') }}">
                                    {{ __('Já possui conta?') }}
                                </a>

                                <x-jet-button class="ml-4">
                                    {{ __('Cadastrar') }}
                                </x-jet-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<script type="text/javascript">
    const text = document.getElementById('textpix');
    const copyButton = document.getElementById('copypix');

    copyButton.addEventListener('click', () => {
        text.select();
        document.execCommand('copy');
    });
</script>
