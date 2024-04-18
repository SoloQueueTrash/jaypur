<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\LikedProduct;
use Illuminate\Support\Facades\Auth;

class ProductLikeController extends Controller
{

    public function toggleLike($id)
    {
        // Find the product
        $product = Products::find($id);

        // Check if the product exists
        if (!$product) {
            return redirect()->back()->with('error', 'Produto não encontrado');
        }

        // Get the authenticated user
        $user = Auth::user();

        $like = LikedProduct::where('user_id', $user->id)->where('product_id', $product->id)->first();

        if ($like !== null) {
            // Unlike the product
            $like->delete();
            return redirect()->back()->with('success', 'Produto removido dos favoritos.');
        } else {
            // Like the product
            LikedProduct::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
            return redirect()->back()->with('success', 'Produto adicionado aos favoritos.');
        }
    }
}
