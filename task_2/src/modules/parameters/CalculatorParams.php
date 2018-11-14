<?php

class CalculatorParams {
    public $name;
    public $estimated_value;
    public $tax_percentage;
    public $instalments;
    public $tz_offset;

    function __construct($name, $estimated_value, $tax_percentage, $instalments, $tz_offset) {
        $this->name            = $name;
        $this->estimated_value = $estimated_value;
        $this->tax_percentage  = $tax_percentage;
        $this->instalments     = $instalments;
        $this->tz_offset       = $tz_offset;
    }

}