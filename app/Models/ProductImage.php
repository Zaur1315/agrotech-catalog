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
        'thumbnail_path',
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

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail_path === null || $this->thumbnail_path === '') {
            return $this->url;
        }

        if (str_starts_with($this->thumbnail_path, 'http://') || str_starts_with($this->thumbnail_path, 'https://')) {
            return $this->thumbnail_path;
        }

        if (str_starts_with($this->thumbnail_path, 'images/')) {
            return asset($this->thumbnail_path);
        }

        return asset('storage/' . ltrim($this->thumbnail_path, '/'));
    }
}
