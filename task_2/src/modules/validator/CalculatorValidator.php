<?php

class CalculatorValidator extends Validator {

    use NumberTrait;
    use DateOffsetTrait;

    public $name;
    public $estimated_value;
    public $tax_percentage;
    public $instalments;
    public $tz_offset;

    public function __construct() {
        $this->name             = new FormField();
        $this->estimated_value  = new FormField();
        $this->tax_percentage   = new FormField();
        $this->instalments      = new FormField();
        $this->tz_offset        = new FormField();
    }

    /**
     * @throws ValidatorException
     */
    public function validate() {
        if (empty($this->name->getValue())) {
            $this->addError('name', 'Empty');
        }
        if (empty($this->estimated_value->getValue())) {
            $this->addError('estimated_value', 'Empty');
        } elseif (!$this->validateNumber($this->estimated_value->getValue())){
            $this->addError('estimated_value', 'Not Valid');
        }

        if (empty($this->tax_percentage->getValue())) {
            $this->addError('tax_percentage', 'Empty');
        } elseif (!$this->validateNumber($this->tax_percentage->getValue())){
            $this->addError('tax_percentage', 'Not Valid');
        }
        if (empty($this->instalments->getValue())) {
            $this->addError('instalments', 'Empty');
        } elseif (!$this->validateNumber($this->instalments->getValue())){
            $this->addError('instalments', 'Not Valid');
        }

        if (empty($this->tz_offset->getValue())) {
            $this->addError('tz_offset', 'Empty');
        } elseif (!$this->validateOffset($this->tz_offset->getValue())){
            $this->addError('tz_offset', 'Not Valid');
        }

        if ($this->hasError()) {
            $ex = new ValidatorException('Invalid fields');
            $ex->setForm($this);
            throw $ex;
        }

    }

}