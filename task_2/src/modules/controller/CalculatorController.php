<?php

class CalculatorController
{
    public function calc() {
        //var_dump(\Env::getRequest()->getRouter()->getParams());
        $form = new CalculatorValidator();
        try {
            $form->fillFromRequest()->validate();
            $params = new CalculatorParams(
                $form->name->getValue(),
                $form->estimated_value->getValue(),
                $form->tax_percentage->getValue(),
                $form->instalments->getValue()
            );

            $calculator = new Calculator($params);
            $calculator->getRates();
            exit;
        } catch (\Exception $e) {
            var_dump($e);
        }

    }
}