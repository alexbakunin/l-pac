<?php

namespace App\View\Composers;

use App\Models\Ship;
use Illuminate\View\View;

class ShipComposer
{
    protected $ships;

    public function __construct(){
        $ships = Ship::pluck('title', 'id')->all();
        $this->ships = $ships;
    }

    public function compose(View $view){
        $view->with('ships', $this->ships);
    }

}
