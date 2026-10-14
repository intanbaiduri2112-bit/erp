<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeSkill extends Model
{
    //
    protected $fillable = ['employee_id','skill_type_id','skill_level_id','skill_id','level_progress','is_default_level','image','effective_date','expiry_date'];

}
