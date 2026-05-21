<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Product extends Model
{
    public const CONDITION_NEW = 'new';
    public const CONDITION_USED = 'used';
    public const CONDITION_REFURBISHED = 'refurbished';

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'sku',
        'short_description',
        'description',
        'price',
        'price_on_request',
        'year',
        'condition',
        'engine',
        'transmission',
        'fuel_type',
        'hours_used',
        'main_image',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'category_id' => 'integer',
        'brand_id' => 'integer',
        'price' => 'decimal:2',
        'price_on_request' => 'boolean',
        'year' => 'integer',
        'hours_used' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class)->orderBy('sort_order');
    }

    public function getFormattedPriceAttribute(): string
    {
        if ($this->price_on_request || $this->price === null) {
            return 'Price on request';
        }

        return '$' . number_format((float)$this->price, 2);
    }
}
