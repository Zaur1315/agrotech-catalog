<?php

declare(strict_types=1);

namespace App\Filament\Resources\Leads\Schemas;

use App\Models\Lead;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

final class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->email()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->required()
                            ->tel()
                            ->maxLength(255),

                        TextInput::make('subject')
                            ->maxLength(255),

                        Select::make('status')
                            ->required()
                            ->options([
                                Lead::STATUS_NEW => 'New',
                                Lead::STATUS_IN_PROGRESS => 'In progress',
                                Lead::STATUS_CLOSED => 'Closed',
                                Lead::STATUS_SPAM => 'Spam',
                            ])
                            ->default(Lead::STATUS_NEW),

                        TextInput::make('source')
                            ->required()
                            ->default('website')
                            ->maxLength(255),

                        Textarea::make('message')
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Requested products')
                    ->schema([
                        Repeater::make('items')
                            ->relationship('items')
                            ->schema([
                                Select::make('product_id')
                                    ->label('Product')
                                    ->relationship('product', 'name')
                                    ->searchable()
                                    ->preload(),

                                TextInput::make('product_name')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('quantity')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1),

                                TextInput::make('price')
                                    ->numeric()
                                    ->prefix('$')
                                    ->minValue(0)
                                    ->step('0.01'),
                            ])
                            ->columns(4)
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
