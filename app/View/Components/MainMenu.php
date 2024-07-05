<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Menu;

class MainMenu extends Component
{
    public $list_menu;

    public function __construct()
    {
        $this->list_menu = Menu::whereNull('parent_id')->with('submenu')->get();
    }

    public function render()
    {
        return view('components.main-menu');
    }
}