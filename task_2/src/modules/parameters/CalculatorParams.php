<?php

class CalculatorParams {
    public $name;
    public $estimated_value;
    public $tax_percentage;
    public $instalments;

    function __construct($name, $estimated_value, $tax_percentage, $instalments) {
        $this->name            = $name;
        $this->estimated_value = $estimated_value;
        $this->tax_percentage  = $tax_percentage;
        $this->instalments     = $instalments;
    }

}