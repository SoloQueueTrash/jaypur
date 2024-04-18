@extends('layout')

@section('content')
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Área Segura</h1>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container px-4 px-lg-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3 text-sm text-gray-600">
                            {{ __('Esta é uma área segura da aplicação. Por favor, confirme a sua senha antes de continuar.') }}
                        </div>

                        <x-validation-errors class="mb-4" />

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="mt-4">
                                <x-label for="password" value="{{ __('Senha') }}" />
                                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ms-4">
                                    {{ __('Confirmar') }}
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
