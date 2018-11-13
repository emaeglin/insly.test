<?php

trait NumberTrait {

    function validateNumber($n) {
        return is_numeric($n);
    }
}