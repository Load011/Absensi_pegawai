<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $table = "att_attshift";

    protected $fillable = [
        'alias',
        'company_id',
    ];
}
