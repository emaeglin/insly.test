<?php

class Calculator {
    private $params = null;
    private $rates = null;
    public function __construct(CalculatorParams $params) {
        $this->params = $params;
    }

    public function getRates() {

    }
}