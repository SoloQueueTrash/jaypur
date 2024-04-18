@extends('layout')

@section('content')
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Perfil</h1>
            <p class="lead fw-normal text-white-50 mb-0">Favoritos e Informações pessoais</p>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">

        <!-- Produtos Favoritos -->
        <div class="card mb-4">
            <div class="card-header">
                <h2 class="text-lg font-medium text-gray-900">Produtos favoritos</h2>
            </div>
            <div class="card-body">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    @foreach($data as $item)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ asset(Storage::url($item->source)) }}" alt="{{ $item->name }}" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $item->name }}</h5>
                                    @auth
                                    <form action="{{ route('like', ['id' => $item->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn mt-auto">
                                            @if(auth()->user()->likes && auth()->user()->likes->contains($item->id))
                                            <i class="fa-solid fa-heart-circle-minus" style="cursor: pointer; color: red; font-size:40px;" title="Remover dos favoritos"></i>
                                            @else
                                            <i class="fa-solid fa-heart-circle-plus" style="cursor: pointer; font-size:40px;" title="Adicionar aos favoritos"></i>
                                            @endif
                                        </button>
                                    </form>
                                    @endauth
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-dark mt-auto" href="{{ route('product', ['id' => $item->id]) }}">Detalhes</a></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container px-4 px-lg-5 mt-5">

            <!-- Change Password -->
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="text-lg font-medium text-gray-900">Alterar palavra-passe</h2>
                    <p class="mt-1 text-sm text-gray-600">Certifica-te que a tua palavra-passe é segura.</p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('password.update') }}" class="mt-4 space-y-4">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-3">
                                <label for="update_password_current_password">Palavra-passe atual</label>
                                <input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password">
                                <div class="mt-2 text-red-500"></div>
                            </div>
                            <div class="col-md-3">
                                <label for="update_password_password">Nova palavra-passe</label>
                                <input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password">
                                <div class="mt-2 text-red-500"></div>
                            </div>
                            <div class="col-md-3">
                                <label for="update_password_password_confirmation">Confirmar nova palavra-passe</label>
                                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password">
                                <div class="mt-2 text-red-500"></div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-dark">Guardar</button>
                            @if (session('status') === 'password-updated')
                            <p class="text-sm text-gray-600 ml-4">Guardado.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="text-lg font-medium text-gray-900">Informação do Perfil</h2>
                    <p class="mt-1 text-sm text-gray-600">Alterar informações de nome e email</p>
                </div>
                <div class="card-body">
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="mt-4 space-y-4">
                        @csrf
                    </form>
                    <form method="post" action="{{ route('profile.update') }}" class="mt-4 space-y-4">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Nome</label>
                                <input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                <div class="mt-2 text-red-500"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email', $user->email) }}" required autocomplete="username">
                                <div class="mt-2 text-red-500"></div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-dark">Guardar alterações</button>
                            @if (session('status') === 'profile-updated')
                            <p class="text-sm text-gray-600 ml-4">Guardado.</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="card">
                <div class="card-header">
                    <h2 class="text-lg font-medium text-gray-900">Apagar conta</h2>
                    <p class="mt-1 text-sm text-gray-600">Esta ação é irreversível. Pensa bem antes de prosseguir.</p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('profile.destroy') }}" class="mt-4 space-y-4">
                        @csrf
                        @method('delete')
                        <div class="row">
                            <div class="col-md-6">
                                <label for="delete_password">Palavra-passe</label>
                                <input id="delete_password" name="password" type="password" class="mt-1 block w-full" autocomplete="current-password">
                                <div class="mt-2 text-red-500"></div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-danger">Apagar conta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection