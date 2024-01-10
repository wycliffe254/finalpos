<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'brand',
        'description',	
        'price',
        'quantity'	
    ];
    protected $dates = ['deleted_at'];

    public function order_details(): BelongsToMany
    {
        return $this->belongsToMany(OrderDetail::class);
    }
}
