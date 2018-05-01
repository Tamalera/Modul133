<?php
class Database
{
    private static $instance = null;
    private function __construct() {
    }
    public static function getBdd() {
        if(is_null(self::$instance)) {
            self::$instance = new PDO("mysql:host=localhost;dbname=blog", 'root', '');
        }
        return self::$instance;
    }
}
?>