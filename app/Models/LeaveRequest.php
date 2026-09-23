<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveRequest extends Model
{
    protected $fillable = [
        'employee_id',
        'leave_type',
        'start_date',
        'end_date',
        'days',
        'reason',
        'status',
        'approved_by',
        'approved_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'start_date'  => 'date',
            'end_date'    => 'date',
            'approved_at' => 'datetime',
        ];
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Accessor: label leave type
     */
    public function getLeaveTypeLabelAttribute(): string
    {
        return match ($this->leave_type) {
            'annual'    => 'Annual Leave',
            'sick'      => 'Sick Leave',
            'maternity' => 'Maternity Leave',
            'unpaid'    => 'Unpaid Leave',
            'emergency' => 'Emergency Leave',
            default     => ucfirst($this->leave_type),
        };
    }

    /**
     * Auto-hitung jumlah hari ketika saving
     */
    protected static function booted(): void
    {
        static::saving(function (LeaveRequest $leave) {
            if ($leave->start_date && $leave->end_date) {
                $leave->days = Carbon::parse($leave->start_date)
                    ->diffInDays(Carbon::parse($leave->end_date)) + 1;
            }
        });
    }
}