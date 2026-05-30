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

                TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(static fn (?string $state): string => match ($state) {
                        Lead::TYPE_GENERAL => 'General',
                        Lead::TYPE_QUOTE => 'Quote',
                        Lead::TYPE_PRODUCT_QUESTION => 'Product question',
                        Lead::TYPE_SERVICE => 'Service',
                        Lead::TYPE_DELIVERY => 'Delivery',
                        Lead::TYPE_FINANCING => 'Financing',
                        default => '-',
                    })
                    ->color(static fn (?string $state): string => match ($state) {
                        Lead::TYPE_QUOTE,
                        Lead::TYPE_PRODUCT_QUESTION => 'success',
                        Lead::TYPE_SERVICE,
                        Lead::TYPE_DELIVERY => 'warning',
                        Lead::TYPE_FINANCING => 'info',
                        Lead::TYPE_GENERAL => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('subject')
                    ->searchable()
                    ->limit(35)
                    ->placeholder('-'),

                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(static fn (?string $state): string => match ($state) {
                        Lead::STATUS_NEW => 'New',
                        Lead::STATUS_IN_PROGRESS => 'In progress',
                        Lead::STATUS_CLOSED => 'Closed',
                        Lead::STATUS_SPAM => 'Spam',
                        default => '-',
                    })
                    ->color(static fn (?string $state): string => match ($state) {
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

                TextColumn::make('source_page')
                    ->label('Source page')
                    ->limit(35)
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('-'),

                TextColumn::make('items_count')
                    ->label('Products')
                    ->counts('items')
                    ->sortable(),

                TextColumn::make('preferred_contact_method')
                    ->label('Contact by')
                    ->badge()
                    ->formatStateUsing(static fn (?string $state): string => match ($state) {
                        Lead::PREFERRED_CONTACT_PHONE => 'Phone',
                        Lead::PREFERRED_CONTACT_EMAIL => 'Email',
                        Lead::PREFERRED_CONTACT_ANY => 'Any',
                        default => '-',
                    })
                    ->toggleable()
                    ->placeholder('-'),

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

                SelectFilter::make('type')
                    ->options([
                        Lead::TYPE_GENERAL => 'General',
                        Lead::TYPE_QUOTE => 'Quote',
                        Lead::TYPE_PRODUCT_QUESTION => 'Product question',
                        Lead::TYPE_SERVICE => 'Service',
                        Lead::TYPE_DELIVERY => 'Delivery',
                        Lead::TYPE_FINANCING => 'Financing',
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
