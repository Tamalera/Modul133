<?php
session_start();

define('ROOT', str_replace("index.php", "", $_SERVER["SCRIPT_FILENAME"]));
require(ROOT . 'misc/core.php');
require(ROOT . 'router.php');
require(ROOT . 'request.php');
require(ROOT . 'dispatcher.php');
$dispatch = new Dispatcher();
$dispatch->dispatch();
?>