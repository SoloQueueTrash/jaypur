<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photos extends Model
{
    use HasFactory;
    protected $table = 'photos';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'source', 'product_id'];

    protected static function booted(): void
    {
        self::deleted(function (Photos $photo) {
            Storage::disk('public')->delete($photo->source);
        });
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
