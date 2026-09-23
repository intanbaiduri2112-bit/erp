<?php

namespace App\Filament\Resources\LeaveRequests\Schemas;

use App\Models\Employee;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LeaveRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Pengajuan')
                ->schema([
                    Select::make('employee_id')
                        ->label('Employee')
                        ->options(
                            Employee::with('user')->get()
                                ->mapWithKeys(fn ($e) => [$e->id => $e->user->name])
                        )
                        ->searchable()
                        ->required(),

                    Select::make('leave_type')
                        ->label('Leave Type')
                        ->options([
                            'annual'    => 'Annual Leave',
                            'sick'      => 'Sick Leave',
                            'maternity' => 'Maternity Leave',
                            'unpaid'    => 'Unpaid Leave',
                            'emergency' => 'Emergency Leave',
                        ])
                        ->required()
                        ->native(false),

                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'pending'   => 'Pending',
                            'approved'  => 'Approved',
                            'rejected'  => 'Rejected',
                            'cancelled' => 'Cancelled',
                        ])
                        ->default('pending')
                        ->required()
                        ->native(false),
                ])
                ->columns(3),

            Section::make('Periode Cuti')
                ->schema([
                    DatePicker::make('start_date')
                        ->label('Start Date')
                        ->native(false)
                        ->displayFormat('d/m/Y')
                        ->default(now())
                        ->required(),

                    DatePicker::make('end_date')
                        ->label('End Date')
                        ->native(false)
                        ->displayFormat('d/m/Y')
                        ->default(now())
                        ->required()
                        ->afterOrEqual('start_date'),

                    Textarea::make('reason')
                        ->label('Reason')
                        ->rows(3)
                        ->columnSpanFull()
                        ->placeholder('Alasan pengajuan cuti...'),
                ])
                ->columns(2),

            Section::make('Approval & Notes')
                ->schema([
                    Textarea::make('notes')
                        ->label('Notes')
                        ->rows(2)
                        ->columnSpanFull()
                        ->placeholder('Catatan dari approver (opsional)'),
                ]),
        ]);
    }
}