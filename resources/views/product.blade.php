@extends('layout')

@section('content')
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="text-center"><a class="btn mt-auto" href="{{ url()->previous() }}" style="margin-bottom: 20px; float: left;"><i class="fa fa-arrow-circle-left" style="font-size:40px"></i></a></div>

            <div class="col-md-6">
                <div class="card h-100">
                    <div class="w3-content" style="max-width:1200px">
                        @php
                        $counter = 0;
                        $counter2 = 0;
                        $counter3 = 0;
                        @endphp
                        @foreach($photos as $photo)
                        @if($counter == '0')
                        <img class="mySlidesProd card-img-top mb-5 mb-md-0 demo" src="{{ asset(Storage::url($photo->source)) }}" alt="{{ $photo->name }}" style="width:100%;">
                        @else
                        <img class="mySlidesProd card-img-top mb-5 mb-md-0 demo" src="{{ asset(Storage::url($photo->source)) }}" alt="{{ $photo->name }}" style="width:100%;display:none;">
                        @endif
                        @php
                        $counter++;
                        @endphp
                        @endforeach

                        @php
                        if(count($photos) == 0){
                        $column_width = 100;
                        }else {
                        $column_width = 100 / count($photos);
                        }

                        $counter2 = 0; // Initialize counter
                        @endphp

                        @foreach($photos as $photo)
                        @if($counter2 % 4 == 0)
                        <div class="w3-row-padding w3-section" id="indicatorRow">
                            @endif

                            <div class="w3-col s3">
                                <img class="w3-opacity w3-hover-opacity-off" src="{{ asset(Storage::url($photo->source)) }}" alt="{{ $photo->name }}" style="width:100%;cursor:pointer;" onclick="currentDiv(<?php echo $counter3; ?>)">
                            </div>

                            @php
                            $counter2++;
                            $counter3++;
                            @endphp

                            @if($counter2 % 4 == 0 || $counter2 == count($photos))
                        </div>
                        @endif

                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <h1 class="display-5 fw-bolder">{{ $product->name }}
                    @auth
                    <form action="{{ route('like', ['id' => $product->id]) }}" method="POST" class="d-inline">
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


                </h1>
                <b> {{ $product->material }} </b>

                <p class="lead">{{ $product->description }}</p>
            </div>
        </div>
    </div>
</section>
<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Produtos semelhantes</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            @foreach($recommended as $item)
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="{{ asset(Storage::url($item->source)) }}" />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">{{ $item->name }}</h5>
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('product', ['id' => $item->id]) }}">Detalhes</a></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection