@extends('layout')

@section('content')
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Produtos</h1>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <!-- Filter dropdown and search bar -->
        <div class="row mb-4">
            <div class="col-md-6">
                <!-- Dropdown for sorting -->
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-filter"></i> Ordenar
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                        <li><a class="dropdown-item" href="{{ route('products', ['sort_by' => 'created_at']) }}"><i class="fas fa-sort-amount-up"></i> Data crescente</a></li>
                        <li><a class="dropdown-item" href="{{ route('products', ['sort_by' => 'created_at_desc']) }}"><i class="fas fa-sort-amount-down"></i> Data decrescente</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Search bar -->
                <form action="{{ route('products') }}" method="GET" class="d-flex">
                    <input class="form-control me-2" type="search" name="search" placeholder="Pesquisar" aria-label="Search">
                    <button class="btn btn-dark" type="submit">Procurar</button>
                </form>
            </div>
        </div>

        <!-- Product cards -->
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

        <!-- Pagination links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $data->links('paginator') }}
        </div>
    </div>
</section>
@endsection