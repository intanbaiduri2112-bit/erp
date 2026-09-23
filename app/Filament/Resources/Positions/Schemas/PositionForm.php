<?php

namespace App\Filament\Resources\Positions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PositionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Position Information')
                    ->icon('heroicon-o-briefcase')
                    ->description('Please provide the position details')
                    ->columns(2)
                    ->columnSpan(3)
                    ->schema([

                        TextInput::make('name')
                            ->label('Position Name')
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Description')
                            ->rows(4)
                            ->nullable()
                            ->columnSpanFull(),

                        TextInput::make('allowance')
                            ->label('Allowance')
                            ->numeric()
                            ->prefix('Rp')
                            ->placeholder('0')
                            ->nullable(),

                    ]),
            ])
            ->columns(4);
    }
}
