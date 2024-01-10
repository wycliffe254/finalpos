<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'orderdetails';
    protected $fillable = [
        'order_id',
        'product_id',
        'brand',
        'quantity',
        'unitprice',
        'discount',
        'total_amount'
        
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
