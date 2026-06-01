<?php

declare(strict_types=1);

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Services\Image\ProductImageThumbnailService;
use Filament\Resources\Pages\CreateRecord;

final class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterCreate(): void
    {
        $this->generateImageThumbnails();
    }

    private function generateImageThumbnails(): void
    {
        $thumbnailService = app(ProductImageThumbnailService::class);

        $this->record->images()
            ->whereNotNull('path')
            ->get()
            ->each(static function ($image) use ($thumbnailService): void {
                if ($image->thumbnail_path !== null && $image->thumbnail_path !== '') {
                    return;
                }

                $derivatives = app(ProductImageThumbnailService::class)->createDerivatives($image->path);

                if ($derivatives === null) {
                    return;
                }

                $image->update([
                    'thumbnail_path' => $derivatives['thumbnail_path'],
                    'medium_path' => $derivatives['medium_path'],
                ]);
            });
    }
}
