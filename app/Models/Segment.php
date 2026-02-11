<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    protected $fillable = ['name'];

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
