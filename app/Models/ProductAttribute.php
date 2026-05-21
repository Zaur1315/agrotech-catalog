<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class ProductAttribute extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'value',
        'sort_order',
    ];

    protected $casts = [
        'product_id' => 'integer',
        'sort_order' => 'integer',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
