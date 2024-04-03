<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Breaktime extends Model
{
    use HasFactory;

    protected $table = "att_breaktime";

    public $timestamps = false;

    protected $fillable = [
        'alias',
        'period_start',
        'duration',
        'end_margin',
        'company_id',
    ];
    public function getCompanyNameAttribute()
    {
        $company = DB::table('personnel_company')->find($this->company_id);
        return $company->company_name ?? null;
    }

}
