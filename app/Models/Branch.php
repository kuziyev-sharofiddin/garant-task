<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = ['name','product_id','quantity', 'price','summ'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }
}
