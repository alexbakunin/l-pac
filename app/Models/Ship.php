<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;

    protected $guarded =[];
    public $timestamps = false;

    public function gallery()
    {
        return $this->hasMany(ShipGallery::class);
    }

    public function cabin()
    {
        return $this->hasMany(CabinCategory::class);
    }

    public function getSpecAttribute($value)
    {
        return json_decode($value);
    }

}
