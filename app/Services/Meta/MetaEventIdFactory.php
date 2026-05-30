<?php

declare(strict_types=1);

namespace App\Services\Meta;

use Illuminate\Support\Str;

final readonly class MetaEventIdFactory
{
    public function make(string $eventName): string
    {
        return sprintf(
            '%s_%s',
            strtolower($eventName),
            (string)Str::uuid(),
        );
    }
}
