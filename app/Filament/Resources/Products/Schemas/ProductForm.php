<?php

declare(strict_types=1);

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

final class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Main information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(static function (string $operation, ?string $state, callable $set): void {
                                if ($operation !== 'create' || $state === null) {
                                    return;
                                }

                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        TextInput::make('sku')
                            ->label('SKU')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('brand_id')
                            ->label('Brand')
                            ->relationship('brand', 'name')
                            ->searchable()
                            ->preload(),

                        Textarea::make('short_description')
                            ->rows(3)
                            ->columnSpanFull(),

                        RichEditor::make('description')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Pricing')
                    ->schema([
                        TextInput::make('price')
                            ->numeric()
                            ->prefix('$')
                            ->minValue(0)
                            ->step('0.01'),

                        Toggle::make('price_on_request')
                            ->label('Price on request')
                            ->default(false),
                    ])
                    ->columns(2),

                Section::make('Technical details')
                    ->schema([
                        TextInput::make('year')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue((int)date('Y') + 1),

                        Select::make('condition')
                            ->options([
                                Product::CONDITION_NEW => 'New',
                                Product::CONDITION_USED => 'Used',
                                Product::CONDITION_REFURBISHED => 'Refurbished',
                            ])
                            ->searchable(),

                        TextInput::make('engine')
                            ->maxLength(255),

                        TextInput::make('transmission')
                            ->maxLength(255),

                        TextInput::make('fuel_type')
                            ->maxLength(255),

                        TextInput::make('hours_used')
                            ->numeric()
                            ->minValue(0),
                    ])
                    ->columns(3),

                Section::make('Images')
                    ->schema([
                        FileUpload::make('main_image')
                            ->label('Main image')
                            ->image()
                            ->directory('products/main')
                            ->visibility('public')
                            ->disk('public')
                            ->columnSpanFull(),

                        Repeater::make('images')
                            ->relationship('images')
                            ->schema([
                                FileUpload::make('path')
                                    ->label('Image')
                                    ->image()
                                    ->directory('products/gallery')
                                    ->visibility('public')
                                    ->disk('public')
                                    ->required(),

                                TextInput::make('alt')
                                    ->label('Alt text')
                                    ->maxLength(255),

                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0),
                            ])
                            ->columns(3)
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),

                Section::make('Attributes')
                    ->schema([
                        Repeater::make('specifications')
                            ->relationship('specifications')
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('value')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0),
                            ])
                            ->columns(3)
                            ->defaultItems(0)
                            ->columnSpanFull(),
                    ]),

                Section::make('Publishing')
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Featured')
                            ->default(false),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
