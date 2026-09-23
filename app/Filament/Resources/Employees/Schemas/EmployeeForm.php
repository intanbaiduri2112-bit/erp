<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            // Link foto (URL)
            TextInput::make('image')
                ->label('Employee Photo (URL)')
                ->url()
                ->maxLength(500)
                ->placeholder('https://example.com/photo.jpg')
                ->nullable()
                ->columnSpanFull(),

            Select::make('user_id')
                ->label('User')
                ->relationship('user', 'name')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('department_id')
                ->label('Department')
                ->relationship('department', 'name')
                ->searchable()
                ->preload()
                ->required(),

            Select::make('position_id')
                ->label('Position')
                ->relationship('position', 'name')
                ->searchable()
                ->preload()
                ->required(),

            TextInput::make('pob')
                ->label('Place of Birth')
                ->required()
                ->maxLength(255),

            DatePicker::make('dob')
                ->label('Date of Birth')
                ->native(false)
                ->displayFormat('d/m/Y')
                ->required(),

            Select::make('gender')
                ->label('Gender')
                ->options([
                    'male'   => 'Male',
                    'female' => 'Female',
                ])
                ->required(),

            Select::make('religion')
                ->label('Religion')
                ->options([
                    'islam'     => 'Islam',
                    'katolik'   => 'Katolik',
                    'protestan' => 'Protestan',
                    'hindu'     => 'Hindu',
                    'buddha'    => 'Buddha',
                ])
                ->required(),

            TextInput::make('phone_number')
                ->label('Phone Number')
                ->tel()
                ->required()
                ->maxLength(20),

            Textarea::make('address')
                ->label('Address')
                ->rows(3)
                ->required()
                ->columnSpanFull(),

            TextInput::make('salary')
                ->label('Salary')
                ->numeric()
                ->prefix('Rp')
                ->required(),

            DatePicker::make('start_date')
                ->label('Start Date')
                ->native(false)
                ->displayFormat('d/m/Y')
                ->required(),

            Select::make('status')
                ->label('Status')
                ->options([
                    'applicant' => 'Applicant',
                    'active'    => 'Active',
                    'trainee'   => 'Trainee',
                    'x'         => 'X',
                ])
                ->default('active')
                ->required(),

        ]);
    }
}