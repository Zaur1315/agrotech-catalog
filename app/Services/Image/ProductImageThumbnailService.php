<?php

declare(strict_types=1);

namespace App\Services\Image;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

final readonly class ProductImageThumbnailService
{
    private const THUMBNAIL_PREFIX = 'thumb_';

    private const THUMBNAIL_WIDTH = 420;

    private const THUMBNAIL_HEIGHT = 0;

    private const THUMBNAIL_QUALITY = 78;

    public function create(string $imagePath): ?string
    {
        $imagePath = ltrim($imagePath, '/');

        if ($imagePath === '' || str_starts_with(basename($imagePath), self::THUMBNAIL_PREFIX)) {
            return null;
        }

        if (! Storage::disk('public')->exists($imagePath)) {
            return null;
        }

        $thumbnailPath = $this->thumbnailPath($imagePath);

        if (Storage::disk('public')->exists($thumbnailPath)) {
            return $thumbnailPath;
        }

        $sourcePath = Storage::disk('public')->path($imagePath);
        $targetPath = Storage::disk('public')->path($thumbnailPath);

        $command = sprintf(
            'cwebp -quiet -q %d -resize %d %d %s -o %s 2>&1',
            self::THUMBNAIL_QUALITY,
            self::THUMBNAIL_WIDTH,
            self::THUMBNAIL_HEIGHT,
            escapeshellarg($sourcePath),
            escapeshellarg($targetPath),
        );

        exec($command, $output, $exitCode);

        if ($exitCode !== 0 || ! file_exists($targetPath)) {
            Log::warning('Product thumbnail generation failed.', [
                'image_path' => $imagePath,
                'thumbnail_path' => $thumbnailPath,
                'exit_code' => $exitCode,
                'output' => $output,
            ]);

            return null;
        }

        return $thumbnailPath;
    }

    public function thumbnailPath(string $imagePath): string
    {
        $directory = dirname($imagePath);
        $filename = pathinfo($imagePath, PATHINFO_FILENAME);

        return $directory.'/'.self::THUMBNAIL_PREFIX.$filename.'.webp';
    }
}
