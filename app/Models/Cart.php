<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'size_id',
        'color_id',
        'quantity',
    ];

    // Define relationships with other models
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(ProductModel::class);
    }

    public function size()
    {
        return $this->belongsTo(ProductSizeModel::class);
    }

    public function color()
    {
        return $this->belongsTo(ProductColorModel::class);
    }
}
