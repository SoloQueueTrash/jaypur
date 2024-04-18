@extends('layout')

@section('content')
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Administrador</h1>
        </div>
    </div>
</header>
<section class="py-5" style="margin: 40px;">

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error')}}
    </div>
    @endif

    @if(session()->has('top_error'))
    <div class="alert alert-danger">
        {{ session()->get('top_error') }}
    </div>
    @endif

    <h2>Produtos</h2>
    <table class="w3-table-all">
        <tr class="tr">
            <th class="th">ID</th>
            <th class="th">Nome</th>
            <th class="th">Descrição</th>
            <th class="th">Preço</th>
            <th class="th">Material</th>
            <th class="th">Dimensões</th>
            <th class="th">Peso</th>
            <th class="th">Adicionado em</th>
            <th class="th">Editado em</th>
            <th class="th">Ações</th> <!-- Add a new header for actions -->
        </tr>
        @foreach($products as $product)
        <tr class="tr">
            <td class="td">{{ $product->id }}</td>
            <td class="td">{{ $product->name }}</td>
            <td class="td">{{ $product->description }}</td>
            <td class="td">{{ $product->price }}</td>
            <td class="td">{{ $product->material }}</td>
            <td class="td">{{ $product->size }}</td>
            <td class="td">{{ $product->weight }}</td>
            <td class="td">{{ $product->created_at}}</td>
            <td class="td">{{ $product->updated_at}}</td>
            <td class="td">
                <button class="edit-btn" onclick="toggleForm('edit-form-{{ $product->id }}')">Editar</button>
                <form class="delete-form" action="{{ route('admin.destroy', ['type' => 'product', 'id' => $product->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <!-- <input type="hidden" name="id" value="{{ $product->id }}"> -->
                    <button type="submit" class="delete-btn" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</button>
                </form>
            </td>
        </tr>
        <tr class="edit-form-row" id="edit-form-row-{{ $product->id }}" style="display: none;">
            <td colspan="9">
                <div class="w3-row, w3-row-padding">
                    <div class="w3-col s6">
                        <h3>Produtos</h3>

                        <form action="{{ route('admin.update', $product->id) }}" method="POST" id="edit-form-{{ $product->id }}" class="edit-form" style="display: none;">
                            @csrf
                            @method('PUT')
                            <label for="name">Nome:</label>
                            <input type="text" id="name" name="name" value="{{ $product->name }}">
                            @if($errors->has("name"))
                            <span class="error">{{ $errors->first("name") }}</span>
                            @endif
                            <label for="description">Descrição:</label>
                            <textarea id="description" name="description">{{ $product->description }}</textarea>
                            @if($errors->has("description"))
                            <span class="error">{{ $errors->first("description") }}</span>
                            @endif
                            <label for="price">Preço:</label>
                            <input type="text" id="price" name="price" value="{{ $product->price }}">
                            @if($errors->has("price"))
                            <span class="error">{{ $errors->first("price") }}</span>
                            @endif
                            <label for="material">Material:</label>
                            <input type="text" id="material" name="material" value="{{ $product->material }}">
                            @if($errors->has("material"))
                            <span class="error">{{ $errors->first("material") }}</span>
                            @endif
                            <label for="size">Dimensões:</label>
                            <input type="text" id="size" name="size" value="{{ $product->size }}">
                            @if($errors->has("size"))
                            <span class="error">{{ $errors->first("size") }}</span>
                            @endif
                            <label for="weight">Peso:</label>
                            <input type="text" id="weight" name="weight" value="{{ $product->weight }}">
                            @if($errors->has("weight"))
                            <span class="error">{{ $errors->first("weight") }}</span>
                            @endif
                            <button type="submit" onclick="return confirm('Tem certeza que deseja submeter as alterações?')">Guardar Alterações</button>
                        </form>
                    </div>
                    <div class="w3-col s6">
                        <h3>Fotos</h3>
                        @php
                        if(count($photos) == 0) {
                        $column_width = 100;
                        } else {
                        $column_width = 100 / count($photos);
                        }

                        $counter2 = 0; // Initialize counter
                        @endphp

                        @foreach($photos as $photo)
                        @if($photo->product_id == $product->id)

                        @if($counter2 % 3 == 0 && $counter2 == 0)
                        <div class="w3-row-padding w3-section">
                            @endif


                            <div class="w3-col s4">
                                <div class="image-container">
                                    <img class="w3-opacity w3-hover-opacity-off" src="{{ Storage::url($photo->source) }}" style="width:100%;cursor:pointer;">
                                    <form class="delete-form" action="{{ route('admin.destroy', ['type' => 'photo', 'id' => $photo->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete-button" type="submit" onclick="return confirm('Tem certeza que deseja apagar a foto?')">Apagar</button>
                                    </form>
                                </div>
                            </div>


                            @php
                            $counter2++;
                            @endphp

                            @if($counter2 % 3 == 0 && $counter2 != 0)
                        </div>
                        <div class="w3-row-padding w3-section">
                            @endif
                            @endif
                            @endforeach

                            @if($counter2 % 3 != 0)
                        </div>
                        @endif
                        <div>
                            <h5>Adicionar foto</h5>
                            <form action="{{ route('admin.upload', ['product_id' => $product->id]) }}" method="post" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <div style="border: 3px solid #ccc;; padding: 10px; margin-bottom: 10px;">
                                    <label>Imagem</label>
                                    <input type="file" name="name[]" multiple id="foto" style="margin-bottom: 10px;">
                                    <button type="submit">Adicionar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </td>
        </tr>
        @endforeach
        <!-- Add the form row here -->
        <!-- Add the form row here -->
        <tr class="tr">
            <td class="td" colspan="9">
                <div class="w3-row w3-row-padding">
                    <div class="w3-col s12">
                        <h2>Adicionar Produto</h2>
                        <form action="{{ route('admin.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input type="text" id="name" name="name" required>
                                @if($errors->has("name"))
                                <span class="error">{{ $errors->first("name") }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="price">Preço:</label>
                                <input type="text" id="price" name="price" required>
                                @if($errors->has("price"))
                                <span class="error">{{ $errors->first("price") }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="material">Material:</label>
                                <input type="text" id="material" name="material" required>
                                @if($errors->has("material"))
                                <span class="error">{{ $errors->first("material") }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="size">Dimensões:</label>
                                <input type="text" id="size" name="size" required>
                                @if($errors->has("size"))
                                <span class="error">{{ $errors->first("size") }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="weight">Peso:</label>
                                <input type="text" id="weight" name="weight" required>
                                @if($errors->has("weight"))
                                <span class="error">{{ $errors->first("weight") }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">Descrição:</label>
                                <textarea id="description" name="description" required style="vertical-align: top;"></textarea>
                                @if($errors->has("description"))
                                <span class="error">{{ $errors->first("description") }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit">Adicionar Produto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </td>
        </tr>


    </table>
</section>
@endsection