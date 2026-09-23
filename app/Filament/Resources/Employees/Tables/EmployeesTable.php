<?php

namespace App\Filament\Resources\Employees\Tables;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                // FOTO
                ImageColumn::make('image')
                    ->label('Photo')
                    ->circular()
                    ->size(45)
                    ->defaultImageUrl(fn ($record) => 
                        'https://ui-avatars.com/api/?name=' . urlencode($record->user->name ?? 'User')
                    ),

                TextColumn::make('user.name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('department.name')
                    ->label('Department')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('position.name')
                    ->label('Position')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('address')
                    ->label('Address')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(),

                TextColumn::make('pob')
                    ->label('Place of Birth')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('dob')
                    ->label('Date of Birth')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('gender')
                    ->label('Gender')
                    ->badge()
                    ->toggleable(),

                TextColumn::make('religion')
                    ->label('Religion')
                    ->toggleable(),

                TextColumn::make('phone_number')
                    ->label('Phone')
                    ->searchable(),

                TextColumn::make('salary')
                    ->label('Salary')
                    ->numeric()
                    ->sortable()
                    ->prefix('Rp ')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                \Filament\Actions\EditAction::make(),
            ])
            ->toolbarActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}