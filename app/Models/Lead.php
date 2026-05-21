<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Lead extends Model
{
    public const STATUS_NEW = 'new';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_CLOSED = 'closed';
    public const STATUS_SPAM = 'spam';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'source',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(LeadItem::class);
    }
}
