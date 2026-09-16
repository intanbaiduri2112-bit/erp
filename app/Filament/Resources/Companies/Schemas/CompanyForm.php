<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Company Information')
                    ->icon('heroicon-o-building-office')
                    ->description('Please provide the company details')
                    ->columns(2)
                    ->columnSpan(3)
                    ->schema([

                           TextInput::make('name')
                         ->label('Company Name')
                         
                            ->required()
                             ->columnSpanFull(),
                        Textarea::make('address')
                            ->label('Address')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required(),

                        TextInput::make('phone_number')
                            ->label('Phone Number')
                            ->tel()
                            ->required(),
                    ]),

                Section::make('Company Logo')
                    ->icon('heroicon-o-photo')
                    ->description('Upload the company logo')
                    ->columnSpan(1)
                    ->schema([

                        FileUpload::make('logo')
                            ->label('Company Logo')
                            ->image()
                            ->disk('public')
                            ->directory('logos')
                            ->visibility('public'),
                    ]),
            ])
            ->columns(4);
    }
}