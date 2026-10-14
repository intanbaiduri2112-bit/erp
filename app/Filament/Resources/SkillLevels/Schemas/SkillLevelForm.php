<?php

namespace App\Filament\Resources\SkillLevels\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SkillLevelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('skill_type_id')
                    ->relationship('skillType', 'name')
                    ->label('Skill Type')
                    ->required(),

                TextInput::make('name')
                    ->required(),
            ]);
    }
}