<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class LeadItem extends Model
{
    protected $fillable = [
        'lead_id',
        'product_id',
        'product_name',
        'quantity',
        'price',
    ];

    protected $casts = [
        'lead_id' => 'integer',
        'product_id' => 'integer',
        'quantity' => 'integer',
        'price' => 'decimal:2',
    ];

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
