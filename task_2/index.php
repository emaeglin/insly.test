<?php
require_once './autoload.php';

try {
    Env::init();
    Env::getRequest()->getRouter()->execute();
} catch (Exception $e) {
    //var_dump($e); exit;
}