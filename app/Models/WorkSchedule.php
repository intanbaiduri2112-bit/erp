<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkSchedule extends Model
{
    protected $fillable = [
        'employee_id',
        'date',
        'shift_start',
        'shift_end',
        'shift_type',
        'location',
        'note',
        'status',
    ];

    /**
     * Casting tipe data
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    /**
     * Relasi ke Employee
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Accessor: durasi kerja dalam format "X jam"
     */
    public function getDurationAttribute(): string
    {
        $start = Carbon::parse($this->shift_start);
        $end   = Carbon::parse($this->shift_end);

        // Handle shift malam (contoh: 22:00 - 06:00)
        if ($end->lessThan($start)) {
            $end->addDay();
        }

        $minutes = $start->diffInMinutes($end);

        return round($minutes / 60, 1) . ' jam';
    }

    /**
     * Accessor: label tipe shift
     */
    public function getShiftTypeLabelAttribute(): string
    {
        return match ($this->shift_type) {
            'morning' => 'Pagi',
            'evening' => 'Sore',
            'night'   => 'Malam',
            'off'     => 'Libur',
            default   => ucfirst($this->shift_type),
        };
    }

    /**
     * Accessor: label status
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'scheduled' => 'Terjadwal',
            'completed' => 'Selesai',
            'absent'    => 'Absen',
            'leave'     => 'Cuti',
            default     => ucfirst($this->status),
        };
    }
}