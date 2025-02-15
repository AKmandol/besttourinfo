<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BolgCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
