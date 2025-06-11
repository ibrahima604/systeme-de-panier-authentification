<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatCard extends Component
{
    public string $title;
    public string $value;
    public string $color;

    public function __construct(string $title, string $value, string $color = 'gray')
    {
        $this->title = $title;
        $this->value = $value;
        $this->color = $color;
    }

    public function render()
    {
        return view('components.stat-card');
    }
}
