<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Slider; 

class SliderShow extends Component
{
    public function __construct()
    {
        //
    }
    public function render()
    {
        $list_slider=Slider::where([['status','=',1],['position','slideshow','slideshow']])
        ->orderBy('sort_order','ASC')->get();
        return view('components.slider-show',compact('list_slider'));
    }
}
