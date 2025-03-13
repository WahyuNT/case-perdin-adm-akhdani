<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'city';
    protected $fillable = ['city_name', 'latitude', 'longitude', 'province', 'island', 'is_abroad', 'country'];

    public function businessTrip()
    {
        return $this->hasMany(BusinessTrip::class);
    }
}
