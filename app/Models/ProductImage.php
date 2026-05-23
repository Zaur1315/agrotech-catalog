<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'path',
        'alt',
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

    public function getUrlAttribute(): string
    {
        if ($this->path === null || $this->path === '') {
            return asset('images/placeholders/product-placeholder.jpg');
        }

        if (str_starts_with($this->path, 'http://') || str_starts_with($this->path, 'https://')) {
            return $this->path;
        }

        if (str_starts_with($this->path, 'images/')) {
            return asset($this->path);
        }

        return asset('storage/' . ltrim($this->path, '/'));
    }
}
