<?php

namespace App\Filament\Resources\LeaveRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class LeaveRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.user.name')
                    ->label('Employee')
                    ->searchable()
                    ->sortable(),

                BadgeColumn::make('leave_type')
                    ->label('Leave Type')
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'annual'    => 'Annual Leave',
                        'sick'      => 'Sick Leave',
                        'maternity' => 'Maternity Leave',
                        'unpaid'    => 'Unpaid Leave',
                        'emergency' => 'Emergency Leave',
                        default     => ucfirst($state),
                    })
                    ->colors([
                        'info'    => 'annual',
                        'warning' => 'sick',
                        'success' => 'maternity',
                        'gray'    => 'unpaid',
                        'danger'  => 'emergency',
                    ]),

                TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('End Date')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('days')
                    ->label('Days')
                    ->badge()
                    ->color('gray')
                    ->alignCenter()
                    ->sortable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state) => ucfirst($state))
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger'  => 'rejected',
                        'gray'    => 'cancelled',
                    ]),

                TextColumn::make('reason')
                    ->label('Reason')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('approver.name')
                    ->label('Approved By')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime('d M Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('employee_id')
                    ->label('Employee')
                    ->relationship('employee.user', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('leave_type')
                    ->label('Leave Type')
                    ->options([
                        'annual'    => 'Annual Leave',
                        'sick'      => 'Sick Leave',
                        'maternity' => 'Maternity Leave',
                        'unpaid'    => 'Unpaid Leave',
                        'emergency' => 'Emergency Leave',
                    ]),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending'   => 'Pending',
                        'approved'  => 'Approved',
                        'rejected'  => 'Rejected',
                        'cancelled' => 'Cancelled',
                    ]),

                Filter::make('date_range')
                    ->form([
                        DatePicker::make('from')->label('Dari Tanggal'),
                        DatePicker::make('until')->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn ($q, $d) => $q->whereDate('start_date', '>=', $d))
                            ->when($data['until'], fn ($q, $d) => $q->whereDate('end_date', '<=', $d));
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('start_date', 'desc');
    }
}