<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\Photos;

class ProductsController extends Controller
{

    // public function index()
    // {
    //     $data = DB::table('products')
    //         ->join('photos', 'products.id', '=', 'photos.product_id')
    //         ->select('products.*', 'photos.source') 
    //         ->paginate(8);

    //     return view("products", ['data' => $data]);
    // }

    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'created_at');

        $sortOptions = [
            'created_at' => 'asc',
            'created_at_desc' => 'desc',
        ];

        $order = $sortOptions[$sortBy] ?? 'desc';
        $search = $request->input('search');

        $query = DB::table('products')
            ->join('photos', 'products.id', '=', 'photos.product_id')
            ->select('products.*', 'photos.source');

        if ($search) {
            $query->where('products.name', 'like', '%' . $search . '%');
        }

        $query->orderBy('products.created_at', $order);

        $data = $query->paginate(8);

        return view('products', ['data' => $data]);
    }


    public function show(string $id)
    {
        $products = products::find($id);

        if (!$products) {
            return redirect()->route('products')->with('error', 'Product not found.');
        }

        $photos = DB::table('photos')->select('photos.*')->where('photos.product_id', $id)->get();

        $recommended = DB::table('products')->select('products.*', 'photos.source')
            ->join('photos', 'products.id', '=', 'photos.product_id')
            ->where('products.id', '<>', $id)
            ->whereRaw('products.id >= (SELECT ROUND(RAND() * (SELECT MAX(id) FROM products)))')
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('product', ['product' => $products, 'photos' => $photos, 'recommended' => $recommended]);
    }
}
