<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\ShiftDetail;

class Shift extends Model
{
    use HasFactory;

    protected $table = "att_attshift";

    protected $fillable = [
        'alias',
        'company_id',
    ];

    public function ShiftDetail(){
        return $this->belongsTo(ShiftDetail::class);
    }
}
