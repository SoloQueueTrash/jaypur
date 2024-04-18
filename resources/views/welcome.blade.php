@extends('layout')

@section('content')
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Jaypur</h1>
            </div>
        </div>
    </header>

    <div class="w3-content w3-display-container">
        @foreach($welcome as $item)
            <div class="mySlides">
                <div class="col mb-5">
                    <div class="card h-100">
                        <img src="{{ asset(Storage::url($item->source)) }}" alt="{{ $item->name }}" style="max-width: 100%; margin: auto;">
                        <div class="text-center">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">{{$item->name}}</h5>
                                </div>

                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('product', ['id' => $item->id]) }}">Detalhes</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
        <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
    </div>
@endsection