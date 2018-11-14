<?php

class Calculator {
    private $params;
    private $date;
    private $rates;
    private $config;
    private $price_of_policy;


    private $base_price_of_policy;
    private $commission;
    private $tax;
    private $total;

    private $instalments = [];


    public function __construct(CalculatorParams $params) {
        $this->params = $params;
        $this->getUserTime();
        $this->config = Env::getConfigs();
        $this->getPriceOfPolicy();
    }

    private function getUserTime() {
        $date = new DateTime('now', new DateTimeZone('UTC'));
        //offset
        $offset = abs($this->params->tz_offset);
        $di = new DateInterval("PT{$offset}H");
        if ($this->params->tz_offset < 0) {
            $di->invert = 1;
        }
        $date->add($di);

        $this->date = $date;
        return true;
    }

    private function getPriceOfPolicy() {
        $this->price_of_policy = $this->config->base_price_of_policy;

        foreach ($this->config->special_price_days as $day) {
            if (
                $day = $this->date->format("l") &&
                $this->date->format("G") > $this->config->special_price_min_hour &&
                $this->date->format("G") < $this->config->special_price_max_hour) {
                $this->price_of_policy = $this->config->special_price_of_policy;
            }
        }
    }

    public function getRates() {
        $this->base_price_of_policy = $this->params->estimated_value * $this->price_of_policy;
        $this->commission = $this->base_price_of_policy * $this->config->commission;
        $this->tax = $this->base_price_of_policy * ($this->params->tax_percentage/100);
        $this->total = $this->commission + $this->params->estimated_value;

        $instalments_item = [
            'base_price_of_policy' => round($this->base_price_of_policy / $this->params->instalments, 2),
            'commission' => round($this->commission / $this->params->instalments, 2),
            'tax' => round($this->tax / $this->params->instalments, 2),
            'total' => round($this->total / $this->params->instalments, 2)
        ];

        for ($i=1; $i<=$this->params->instalments; $i++) {
            array_push($this->instalments, $instalments_item);
        }

        return [
            'policy'        => [
                'value'     => $this->params->estimated_value,
                'base_price_of_policy' => round($this->base_price_of_policy, 2),
                'commission' => round($this->commission, 2),
                'tax' => round($this->tax, 2),
                'total' => round($this->total, 2)
            ],
            'instalments'   => $this->instalments
        ];
    }
}