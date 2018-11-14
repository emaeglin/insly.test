<?php

trait DateOffsetTrait {

    function validateOffset($n) {
        if (!is_numeric($n)) {
            return false;
        }
        if ($n > 12) {
            return false;
        }
        if ($n < -12) {
            return false;
        }

        return true;
    }
}