<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Timetable;

class ShiftDetail extends Model
{
    use HasFactory;

    protected $table = "att_shiftdetail";

    protected $fillable = [
        'in_time',
        'day_index',
        'shift_id',
        'time_intterval_id'
    ];

    public function timetable(){
        return $this->belongsTo(Timetable::class, 'timetable_id');
    }

    public function shift(){
        return $this->belongsTo(Shift::class,'shift_id');
    }
}
