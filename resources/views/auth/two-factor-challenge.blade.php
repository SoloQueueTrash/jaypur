@extends('layout')

@section('content')
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Entrar</h1>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container px-4 px-lg-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('two-factor.login') }}">
                            @csrf

                            <div class="mb-3 text-sm text-gray-600">
                                {{ __('Por favor, confirme o acesso à sua conta introduzindo o código de autenticação fornecido pela sua aplicação autenticadora.') }}
                            </div>

                            <x-validation-errors class="mb-4" />

                            <div class="mt-4">
                                <x-label for="code" value="{{ __('Código') }}" />
                                <x-input id="code" class="block mt-1 w-full" type="text" inputmode="numeric" name="code" autofocus autocomplete="one-time-code" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ms-4">
                                    {{ __('Entrar') }}
                                </x-button>
                            </div>

                            <div class="mt-4 text-sm text-gray-600">
                                {{ __('Ou') }}
                            </div>

                            <div class="mt-4">
                                <x-label for="recovery_code" value="{{ __('Código de Recuperação') }}" />
                                <x-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" autocomplete="one-time-code" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ms-4">
                                    {{ __('Entrar com código de recuperação') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection