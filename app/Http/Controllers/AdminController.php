<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\Photos;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function create()
    {
        $products = DB::table('products')->select('products.*')->get();
        $photos = DB::table('photos')->select('photos.*')->get();

        return view('administrator', ['products' => $products, 'photos' => $photos]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array(
                'name' => 'required|max:255',
                'material' => 'required|max:255',
                'description' => 'required',
                'weight' => 'required|numeric|min:0',
                'size' => 'required|max:255',
                'price' => 'required|numeric|min:0',

            ),
            array(
                'name.required' => 'O nome é obrigatório.',
                'name.max' => 'O nome não pode ter mais de 255 caracteres.',
                'material.required' => 'O material é obrigatório.',
                'material.max' => 'O material não pode ter mais de 255 caracteres.',
                'description.required' => 'A descrição é obrigatória.',
                'weight.required' => 'O peso é obrigatório.',
                'weight.numeric' => 'O peso deve ser numérico.',
                'weight.min' => 'O peso deve ser no mínimo :min.',
                'size.required' => 'O tamanho é obrigatório.',
                'size.max' => 'O tamanho não pode ter mais de 255 caracteres.',
                'price.required' => 'O preço é obrigatório.',
                'price.numeric' => 'O preço deve ser numérico.',
                'price.min' => 'O preço deve ser no mínimo :min.',
            )
        );

        if ($validator->fails()) {
            return redirect()->back()->with('top_error', 'Não foi possível criar produto: ' . $validator->errors()->first());
        }

        Products::create($request->all());
        return redirect('admin')->withSuccess('Produto Adicionado');
    }

    public function upload(Request $request, $product_id)
    {
        if ($request->hasFile('name')) {
            foreach ($request->file('name') as $file) {
                $foto = new Photos();

                $photo = Storage::disk('public')->put('/', $file);

                $foto->product_id = $product_id;
                $foto->name = $file;
                $foto->source = $photo;
                $foto->save();
            }
            return redirect('admin')->withSuccess('Fotografias Adicionadas');
        }
        return redirect('admin')->withErrors('Nenhuma imagem selecionada');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            array(
                'name' => 'required|max:255',
                'material' => 'required|max:255',
                'description' => 'required',
                'weight' => 'required|numeric|min:0',
                'size' => 'required|max:255',
                'price' => 'required|numeric|min:0',

            ),
            array(
                'name.required' => 'O nome é obrigatório.',
                'name.max' => 'O nome não pode ter mais de 255 caracteres.',
                'material.required' => 'O material é obrigatório.',
                'material.max' => 'O material não pode ter mais de 255 caracteres.',
                'description.required' => 'A descrição é obrigatória.',
                'weight.required' => 'O peso é obrigatório.',
                'weight.numeric' => 'O peso deve ser numérico.',
                'weight.min' => 'O peso deve ser no mínimo :min.',
                'size.required' => 'O tamanho é obrigatório.',
                'size.max' => 'O tamanho não pode ter mais de 255 caracteres.',
                'price.required' => 'O preço é obrigatório.',
                'price.numeric' => 'O preço deve ser numérico.',
                'price.min' => 'O preço deve ser no mínimo :min.',
            )
        );

        if ($validator->fails()) {
            return redirect()->back()->with('top_error', 'Não foi possível atualizar o produto ' . $id . ': ' . $validator->errors()->first());
        }

        $produto = Products::findOrFail($id);
        $produto->fill($request->all());
        $produto->save();
        return redirect('admin')->withSuccess('Produto atualizado com sucesso.');
    }

    public function destroy(Request $request, $type, $id)
    {
        $tipo = '';
        if ($type == 'product') {
            $photos = Photos::where('product_id', $id)->get();

            foreach ($photos as $photo) {
                Storage::disk('public')->delete($photo->source);
            }

            Products::find($id)->delete();
            $tipo = 'Produto apagado';
        } else if ($type == 'photo') {
            Photos::find($id)->delete();
            $tipo = 'Foto apagada';
        }

        return redirect('admin')->withSuccess("{$tipo} com sucesso.");
    }
}
