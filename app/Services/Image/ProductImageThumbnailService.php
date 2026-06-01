<?php

declare(strict_types=1);

namespace App\Services\Image;

use Illuminate\Support\Facades\File;
use RuntimeException;

final readonly class ProductImageThumbnailService
{
    private const THUMBNAIL_PREFIX = 'thumb_';

    private const MEDIUM_PREFIX = 'medium_';

    private const THUMBNAIL_WIDTH = 420;

    private const MEDIUM_WIDTH = 1200;

    private const AUTO_HEIGHT = 0;

    private const THUMBNAIL_QUALITY = 78;

    private const MEDIUM_QUALITY = 82;

    /**
     * @return array{thumbnail_path:string, medium_path:string}
     */
    public function createDerivatives(string $relativePath): array
    {
        $thumbnailPath = $this->createDerivative(
            relativePath: $relativePath,
            prefix: self::THUMBNAIL_PREFIX,
            width: self::THUMBNAIL_WIDTH,
            quality: self::THUMBNAIL_QUALITY,
        );

        $mediumPath = $this->createDerivative(
            relativePath: $relativePath,
            prefix: self::MEDIUM_PREFIX,
            width: self::MEDIUM_WIDTH,
            quality: self::MEDIUM_QUALITY,
        );

        return [
            'thumbnail_path' => $thumbnailPath,
            'medium_path' => $mediumPath,
        ];
    }

    public function createThumbnail(string $relativePath): string
    {
        return $this->createDerivative(
            relativePath: $relativePath,
            prefix: self::THUMBNAIL_PREFIX,
            width: self::THUMBNAIL_WIDTH,
            quality: self::THUMBNAIL_QUALITY,
        );
    }

    public function createMedium(string $relativePath): string
    {
        return $this->createDerivative(
            relativePath: $relativePath,
            prefix: self::MEDIUM_PREFIX,
            width: self::MEDIUM_WIDTH,
            quality: self::MEDIUM_QUALITY,
        );
    }

    private function createDerivative(string $relativePath, string $prefix, int $width, int $quality): string
    {
        $sourcePath = storage_path('app/public/'.ltrim($relativePath, '/'));

        if (! File::exists($sourcePath)) {
            throw new RuntimeException(sprintf('Source image does not exist: %s', $sourcePath));
        }

        $directory = dirname($relativePath);
        $filename = pathinfo($relativePath, PATHINFO_FILENAME);

        $targetRelativePath = sprintf('%s/%s%s.webp', $directory, $prefix, $filename);
        $targetPath = storage_path('app/public/'.$targetRelativePath);

        File::ensureDirectoryExists(dirname($targetPath));

        $command = sprintf(
            'cwebp -quiet -q %d -resize %d %d %s -o %s 2>&1',
            $quality,
            $width,
            self::AUTO_HEIGHT,
            escapeshellarg($sourcePath),
            escapeshellarg($targetPath),
        );

        exec($command, $output, $exitCode);

        if ($exitCode !== 0) {
            throw new RuntimeException(sprintf(
                'Failed to create derivative image. Command output: %s',
                implode(PHP_EOL, $output),
            ));
        }

        return $targetRelativePath;
    }
}
