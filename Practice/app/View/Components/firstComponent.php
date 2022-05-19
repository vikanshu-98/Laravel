<?php

namespace App\View\Components;

use Illuminate\View\Component;

class firstComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $name; 
    public $label; 
    public $value;
    public $fieldvalue;
    public $dataGender;
    public function __construct($type,$name,$label,$value=null,$gender='')
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        
        $this->value = $value;
        $this->dataGender = $gender; 
        // $this->fieldvalue = $fieldvalue;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.first-component');
    }
}
