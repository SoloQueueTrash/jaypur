@extends('layout')

@section('content')
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Verificação de Email</h1>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container px-4 px-lg-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4 text-center text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Obrigado por se registar! Antes de começar, poderia verificar o seu endereço de email clicando no link que acabamos de enviar? Se não recebeu o email, podemos enviar-lhe outro com prazer.') }}
                        </div>

                        @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-center text-sm text-green-600 dark:text-green-400">
                            {{ __('Foi enviado um novo link de verificação para o endereço de email fornecido durante o registo.') }}
                        </div>
                        @endif

                        <div class="mt-4 flex items-center justify-center">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <div class="mr-4">
                                    <x-primary-button>
                                        {{ __('Reenviar Email de Verificação') }}
                                    </x-primary-button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                    {{ __('Sair') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection