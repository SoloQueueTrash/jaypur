<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\Photos;

class PhotosController extends Controller
{
    public function welcome()
    {
        $welcome = DB::table('products')
            ->join('photos', 'products.id', '=', 'photos.product_id')
            ->orderBy('products.created_at')
            ->select('products.*', 'photos.source') // Selecting columns from both tables
            ->limit(4)
            ->get();

        return view('welcome', ['welcome' => $welcome]);
    }
}
