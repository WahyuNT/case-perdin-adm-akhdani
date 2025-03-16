<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessTrip extends Model
{
    use HasFactory;
    protected $table = 'business_trip';
    protected $fillable = ['user_id', 'purpose_destination', 'departure_date', 'return_date', 'origin_city_id', 'destination_city_id', 'trip_duration', 'status', 'allowance', 'distance'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function originCity()
    {
        return $this->belongsTo(City::class, 'origin_city_id');
    }

    public function destinationCity()
    {
        return $this->belongsTo(City::class, 'destination_city_id');
    }
}
