<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Store extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','branch_id', 'quantity','price'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id','id');
    }
}
