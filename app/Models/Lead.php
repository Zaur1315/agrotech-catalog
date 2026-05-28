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

    public const TYPE_GENERAL = 'general';
    public const TYPE_QUOTE = 'quote';
    public const TYPE_PRODUCT_QUESTION = 'product_question';
    public const TYPE_SERVICE = 'service';
    public const TYPE_DELIVERY = 'delivery';
    public const TYPE_FINANCING = 'financing';

    public const PREFERRED_CONTACT_PHONE = 'phone';
    public const PREFERRED_CONTACT_EMAIL = 'email';
    public const PREFERRED_CONTACT_ANY = 'any';

    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
        'preferred_contact_method',
        'subject',
        'message',
        'status',
        'source',
        'source_page',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_content',
        'utm_term',
        'fbp',
        'fbc',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(LeadItem::class);
    }
}
