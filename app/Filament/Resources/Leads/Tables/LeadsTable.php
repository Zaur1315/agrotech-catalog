<?php

declare(strict_types=1);

namespace App\Filament\Resources\Leads\Tables;

use App\Models\Lead;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class LeadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('email')
                    ->searchable()
                    ->copyable()
                    ->placeholder('-'),

                TextColumn::make('subject')
                    ->searchable()
                    ->limit(35)
                    ->placeholder('-'),

                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(static fn(?string $state): string => match ($state) {
                        Lead::STATUS_NEW => 'New',
                        Lead::STATUS_IN_PROGRESS => 'In progress',
                        Lead::STATUS_CLOSED => 'Closed',
                        Lead::STATUS_SPAM => 'Spam',
                        default => '-',
                    })
                    ->color(static fn(?string $state): string => match ($state) {
                        Lead::STATUS_NEW => 'info',
                        Lead::STATUS_IN_PROGRESS => 'warning',
                        Lead::STATUS_CLOSED => 'success',
                        Lead::STATUS_SPAM => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('source')
                    ->badge()
                    ->sortable(),

                TextColumn::make('items_count')
                    ->label('Products')
                    ->counts('items')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        Lead::STATUS_NEW => 'New',
                        Lead::STATUS_IN_PROGRESS => 'In progress',
                        Lead::STATUS_CLOSED => 'Closed',
                        Lead::STATUS_SPAM => 'Spam',
                    ]),

                SelectFilter::make('source')
                    ->options([
                        'website' => 'Website',
                        'quote_cart' => 'Quote cart',
                        'product_page' => 'Product page',
                        'contact_page' => 'Contact page',
                    ]),
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
