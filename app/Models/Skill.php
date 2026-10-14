<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
    protected $fillable = [
        'skill_type_id',
        'name',
    ];

    public function skillType(): BelongsTo
    {
        return $this->belongsTo(SkillType::class);
    }
}