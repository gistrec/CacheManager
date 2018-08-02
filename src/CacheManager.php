<?php

use RuntimeException;

class CacheManager {

    private static $instance = null;

    private $handler;

    public static function getInstance() {
        if (null === self::$instance) {
            self::$instance = new self();
            // Загружаем конфиг
            include('./config.php');
            // TODO: set handler
        }
        return self::$instance;
    }

    private function __clone() {}
    private function __construct() {}

    public function setHandler() {
        // TODO!
    }

    public function getHandler() {
        // TODO!
    }

    public function set($key, $data, $ttl = -1) {
        // TODO!
    }

    public function get($key) {
       // TODO!
    }

    public function del($key) {
        // TODO!
    }
}