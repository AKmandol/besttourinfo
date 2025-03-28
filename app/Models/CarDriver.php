<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarDriver extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function carOrder()
    {
        return $this->belongsTo(carOrder::class);
    }
}
