<?php

declare(strict_types=1);

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Services\Image\ProductImageThumbnailService;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterSave(): void
    {
        $this->generateImageThumbnails();
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
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

                $thumbnailPath = $thumbnailService->create($image->path);

                if ($thumbnailPath === null) {
                    return;
                }

                $image->update([
                    'thumbnail_path' => $thumbnailPath,
                ]);
            });
    }
}
