<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breaktime extends Model
{
    use HasFactory;

    protected $tabel = "att_breaktime";

    protected $fillable = [
        'alias',
        'period_start',
        'duration',
        'end_margin',
        'company_id',
    ];
}
