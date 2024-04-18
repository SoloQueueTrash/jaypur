<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Products extends Model
{
    use HasFactory;
    public $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'price', 'material', 'size', 'weight'];

    /**
     * Get the photos for the product.
     */
    public function photos()
    {
        return $this->hasMany(Photos::class, 'product_id');
    }

    // app/Models/Product.php

    public function likedBy()
    {
        return $this->hasMany(LikedProduct::class);
    }
}
