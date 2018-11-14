<?php


class Configs {

    private static $instance;

    public $base_price_of_policy       = 0.11;
    public $special_price_of_policy    = 0.13;

    public $special_price_days     = ['Friday'];
    public $special_price_min_hour = 15;
    public $special_price_max_hour = 20;

    public $commission             = 0.17;


    public static function getInstance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}