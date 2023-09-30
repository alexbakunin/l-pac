<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabinCategory extends Model
{
    use HasFactory;

    protected $table = 'cabin_categories';

    protected $guarded =[];
    public $timestamps = false;

    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }

    public function getPhotosAttribute($value)
    {
        return json_decode($value);

    }

}
