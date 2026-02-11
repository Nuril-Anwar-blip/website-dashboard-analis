<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KpiResult extends Model
{
    protected $fillable = ['survey_id', 'kpi_name', 'kpi_value', 'period'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
