<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $table = 'att_timeinterval';
    
    protected $fillable = [
        'alias',
        'in_time',
        'duration',
        'in_ahead_margin',
        'in_above_margin',
        'out_ahead_margin',
        'out_above_margin',
        'duration',
        'min_early_in',
        'min_late_out',
        'work_time_duration',
        'max_ot_limit',
        'company_id',
    ];
    
}
