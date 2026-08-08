<?php

use App\Models\ProductImage;
use App\Services\Image\ProductImageThumbnailService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('inventory:generate-images {--force : Recreate existing medium and thumbnail files}', function (): void {
    $service = app(ProductImageThumbnailService::class);
    $force = (bool) $this->option('force');
    $generated = 0;
    $skipped = 0;
    $failed = 0;

    ProductImage::query()
        ->whereNotNull('path')
        ->where('path', '!=', '')
        ->orderBy('id')
        ->each(function (ProductImage $image) use ($service, $force, &$generated, &$skipped, &$failed): void {
            try {
                $hasDerivatives = $image->thumbnail_path !== null
                    && $image->thumbnail_path !== ''
                    && $image->medium_path !== null
                    && $image->medium_path !== ''
                    && file_exists(storage_path('app/public/'.$image->thumbnail_path))
                    && file_exists(storage_path('app/public/'.$image->medium_path));

                if (! $force && $hasDerivatives) {
                    $skipped++;

                    return;
                }

                $derivatives = $service->createDerivatives($image->path);
                $image->update($derivatives);
                $generated++;
            } catch (\Throwable $exception) {
                $failed++;
                $this->error(sprintf('Image #%d: %s', $image->id, $exception->getMessage()));
            }
        });

    $this->info(sprintf('Generated: %d, skipped: %d, failed: %d', $generated, $skipped, $failed));

    if ($failed > 0) {
        $this->fail('Some product images could not be processed.');
    }
})->purpose('Generate medium and thumbnail images for inventory');
