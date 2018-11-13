<?php

abstract class Validator {

    private $hasError;

    public function addError($field, $errorMsg) {
        $this->{$field}->setError(Utils::trans($errorMsg));
        $this->hasError = true;
    }

    /**
     * @return bool
     */
    public function hasError() {
        return (bool)$this->hasError;
    }

    /**
     * @return bool
     */
    public function isFormSubmitted() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    /**
     * @return Validator
     */
    public function fillFromRequest() {

        foreach($this as $field => $value){
            if($this->{$field} instanceof FormField && Env::getRequest()->getParam($field) !== null){
                $this->{$field}->setValue(Env::getRequest()->getParam($field));
            }
        }
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $fields = [];

        foreach($this as $field => $value){
            if($this->{$field} instanceof FormField){
                $fields[$field]['value'] = $this->{$field}->getValue();
                $fields[$field]['error'] = $this->{$field}->getError();
            }
        }
        return $fields;
    }

    /**
     * @return string
     */
    public function getAllErrorsBr()
    {
        $errors = '';
        foreach($this as $field => $value){
            if($this->{$field} instanceof FormField && !empty($this->{$field}->getError())){
                $errors .= $field . ': ' . $this->{$field}->getError() . '<br />';
            }
        }

        return $errors;
    }

    abstract function validate();

}