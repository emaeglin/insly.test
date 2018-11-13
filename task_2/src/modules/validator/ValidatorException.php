<?php

class ValidatorException extends \Exception {

    /**
     * @var array
     */
    private $form;

    /**
     * ValidatorException constructor.
     * @param string $message
     */
    function __construct($message) {
        parent::__construct($message);
    }

    function getErrorResponse() {
        return new Error($this->message);
    }

    function setForm(Validator $form){
        $this->form = $form;
    }

    function getForm(){
        return $this->form;
    }
}