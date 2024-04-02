<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Employee;
use App\Shift;

class Schedule extends Model
{
    use HasFactory;

    protected $table = "att_attschedule";

    protected $fillable = [
        'start_date',
        'end_date',
        'employee_id',
        'shift_id',
    ];

    public function employees(){
        return $this->hasMany(Employee::class, 'employee_id');
    }

    public function shift(){
        return $this->hasMany(Shift::class,'shift_id');
    }
}
