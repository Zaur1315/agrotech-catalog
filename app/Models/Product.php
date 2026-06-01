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

    public const STATUS_AVAILABLE = 'available';

    public const STATUS_PENDING = 'pending';

    public const STATUS_SOLD = 'sold';

    public const STATUS_HIDDEN = 'hidden';

    public const DRIVE_TYPE_2WD = '2wd';

    public const DRIVE_TYPE_4WD = '4wd';

    public const DRIVE_TYPE_MFWD = 'mfwd';

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'sku',
        'stock_number',
        'serial_number',
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
        'horsepower',
        'drive_type',
        'main_image',
        'location',
        'status',
        'sort_order',
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
        'horsepower' => 'integer',
        'sort_order' => 'integer',
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

    public function specifications(): HasMany
    {
        return $this->hasMany(ProductAttribute::class)->orderBy('sort_order');
    }

    public function getFormattedPriceAttribute(): string
    {
        if ($this->price_on_request || $this->price === null) {
            return 'Price on request';
        }

        return '$'.number_format((float) $this->price, 2);
    }

    public function getMainImageUrlAttribute(): string
    {
        if ($this->main_image === null || $this->main_image === '') {
            return asset('images/placeholders/product-placeholder.jpg');
        }

        if (str_starts_with($this->main_image, 'http://') || str_starts_with($this->main_image, 'https://')) {
            return $this->main_image;
        }

        if (str_starts_with($this->main_image, 'images/')) {
            return asset($this->main_image);
        }

        return asset('storage/'.ltrim($this->main_image, '/'));
    }

    public function getCardImageUrlAttribute(): string
    {
        $primaryImage = $this->relationLoaded('images')
            ? $this->images->sortBy('sort_order')->first()
            : $this->images()->orderBy('sort_order')->orderBy('id')->first();

        if ($primaryImage instanceof ProductImage) {
            return $primaryImage->medium_url;
        }

        if ($this->main_image !== null && $this->main_image !== '') {
            return asset('storage/' . ltrim($this->main_image, '/'));
        }

        return asset('images/placeholders/product-placeholder.jpg');
    }
}
