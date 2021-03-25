<?php

require_once("vendor/autoload.php");

$f3 = Base::instance();

$f3->config('app/config.ini');
$f3->config('app/routes.ini');

new Session();

$f3->run();
