<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = ['survey_id', 'user_id', 'region_id', 'segment_id'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function segment()
    {
        return $this->belongsTo(Segment::class);
    }

    public function details()
    {
        return $this->hasMany(ResponseDetail::class, 'response_id');
    }
}
