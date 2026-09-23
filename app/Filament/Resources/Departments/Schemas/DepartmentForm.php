<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Department Information')
                    ->icon('heroicon-o-building-office-2')
                    ->description('Please provide the department details')
                    ->columns(2)
                    ->columnSpan(3)
                    ->schema([

                        TextInput::make('name')
                            ->label('Department Name')
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Description')
                            ->rows(4)
                            ->nullable()
                            ->columnSpanFull(),

                        Textarea::make('address')
                            ->label('Address')
                            ->rows(3)
                            ->nullable()
                            ->columnSpanFull(),

                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->nullable(),

                        TextInput::make('phone_number')
                            ->label('Phone Number')
                            ->tel()
                            ->nullable(),

                    ]),
            ])
            ->columns(4);
    }
}

