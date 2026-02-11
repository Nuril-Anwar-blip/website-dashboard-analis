<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name'];

    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
