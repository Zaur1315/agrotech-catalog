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

                        Select::make('preferred_contact_method')
                            ->label('Preferred contact method')
                            ->options([
                                Lead::PREFERRED_CONTACT_PHONE => 'Phone',
                                Lead::PREFERRED_CONTACT_EMAIL => 'Email',
                                Lead::PREFERRED_CONTACT_ANY => 'Any',
                            ])
                            ->default(Lead::PREFERRED_CONTACT_ANY),

                        TextInput::make('subject')
                            ->maxLength(255),

                        Select::make('type')
                            ->required()
                            ->options([
                                Lead::TYPE_GENERAL => 'General',
                                Lead::TYPE_QUOTE => 'Quote',
                                Lead::TYPE_PRODUCT_QUESTION => 'Product question',
                                Lead::TYPE_SERVICE => 'Service',
                                Lead::TYPE_DELIVERY => 'Delivery',
                                Lead::TYPE_FINANCING => 'Financing',
                            ])
                            ->default(Lead::TYPE_GENERAL),

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

                        TextInput::make('source_page')
                            ->label('Source page')
                            ->maxLength(255),

                        Textarea::make('message')
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Tracking')
                    ->schema([
                        TextInput::make('utm_source')
                            ->label('UTM source')
                            ->maxLength(255),

                        TextInput::make('utm_medium')
                            ->label('UTM medium')
                            ->maxLength(255),

                        TextInput::make('utm_campaign')
                            ->label('UTM campaign')
                            ->maxLength(255),

                        TextInput::make('utm_content')
                            ->label('UTM content')
                            ->maxLength(255),

                        TextInput::make('utm_term')
                            ->label('UTM term')
                            ->maxLength(255),

                        TextInput::make('fbp')
                            ->label('Meta FBP')
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated(),

                        TextInput::make('fbc')
                            ->label('Meta FBC')
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated(),

                        TextInput::make('ip_address')
                            ->label('IP address')
                            ->maxLength(45)
                            ->disabled()
                            ->dehydrated(),

                        Textarea::make('user_agent')
                            ->label('User agent')
                            ->rows(3)
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->collapsed(),

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
