<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Driver;
use App\Models\RestaurantReview;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RestaurantBranche extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function restaurantReviews()
    {
        return $this->hasMany(RestaurantReview::class);
    }
  
}
