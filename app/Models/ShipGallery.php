<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipGallery extends Model
{
    use HasFactory;

    protected $table = 'ships_gallery';

    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }

}
