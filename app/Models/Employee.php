<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'department_id',
        'position_id',
        'address',
        'pob',
        'dob',
        'gender',
        'religion',
        'phone_number',
        'salary',
        'start_date',
        'status',
        'image',
    ];

    /**
     * Relasi ke User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Department
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function leaveRequests(): HasMany
{
    return $this->hasMany(LeaveRequest::class);
}
    /**
     * Relasi ke Position
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Casting tipe data
     */
    protected function casts(): array
    {
        return [
            'dob' => 'date',
            'start_date' => 'date',
            'salary' => 'decimal:2',
        ];
    }
}
