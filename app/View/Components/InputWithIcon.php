<?php
namespace App\View\Components;

use Illuminate\View\Component;

class InputWithIcon extends Component
{
    public $id, $label, $type, $name, $icon, $value;

    public function __construct($id, $label, $type = 'text', $name, $icon = '', $value = '')
    {
        $this->id = $id;
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->icon = $icon;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.input-with-icon');
    }
}
