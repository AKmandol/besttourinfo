<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carOrder extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function CarDriver()
    {
        return $this->hasMany(CarDriver::class);
    }
}
