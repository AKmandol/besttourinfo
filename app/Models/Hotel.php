<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $guarded = [];

    // public function images(){
    //     return $this->belongsToMany(HotelImages::class,'hotel_images');
    // }
    // public function features(){
    //     return $this->belongsToMany(HotelFeatures::class,'hotel_features');
    // }
    // public function payments(){
    //     return $this->belongsToMany(HotelPayments::class,'hotel_payments');
    // }
    public function images()
    {
        return $this->hasMany(HotelImages::class);
    }
    public function features()
    {
        return $this->hasMany(HotelFeatures::class);
    }
    public function payments()
    {
        return $this->hasMany(HotelPayments::class);
    }
    public function rent()
    {
        return $this->hasMany(HotelRent::class);
    }
    public function instruction()
    {
        return $this->hasMany(HotelInstruction::class);
    }
    
}
