<?php

declare(strict_types=1);

namespace App\Filament\Resources\Products\Tables;

use App\Models\Product;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

final class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('main_image_url')
                    ->label('Image')
                    ->getStateUsing(static fn(Product $record): string => $record->main_image_url)
                    ->square(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('brand.name')
                    ->label('Brand')
                    ->sortable()
                    ->searchable()
                    ->placeholder('-'),

                TextColumn::make('price')
                    ->money('USD')
                    ->sortable()
                    ->placeholder('On request'),

                TextColumn::make('condition')
                    ->badge()
                    ->formatStateUsing(static fn(?string $state): string => match ($state) {
                        'new' => 'New',
                        'used' => 'Used',
                        'refurbished' => 'Refurbished',
                        default => '-',
                    })
                    ->color(static fn(?string $state): string => match ($state) {
                        'new' => 'success',
                        'used' => 'warning',
                        'refurbished' => 'info',
                        default => 'gray',
                    }),

                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('brand_id')
                    ->label('Brand')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('condition')
                    ->options([
                        'new' => 'New',
                        'used' => 'Used',
                        'refurbished' => 'Refurbished',
                    ]),

                TernaryFilter::make('is_featured')
                    ->label('Featured'),

                TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
