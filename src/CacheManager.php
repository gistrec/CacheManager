<?php

require __DIR__. '/Handler/FileSystemHandler.php';

//use RuntimeException;

class CacheManager {

    private static $instance = null;

    private static $handler;

    public static function getInstance() {
        if (null === self::$instance) {
            self::$instance = new self();
            // Загружаем конфиг
            include(__DIR__ . '/config.php');
            switch ($handler) {
                case 'FileSystem':
                    $handler = new FileSystemHandler($cachePath);
                    self::setHandler($handler);
                    break;
                // TODO: exeption
            }
        }
        return self::$instance;
    }

    private function __clone() {}
    private function __construct() {}

    private static function setHandler($handler) {
        self::$handler = $handler;
    }

    private static function getHandler() {
        return self::$handler;
    }

    public static function set($key, $data, $ttl = -1) {
        return self::getHandler()->set($key, $data, $ttl);
    }

    public static function get($key) {
        return self::getHandler()->get($key);
    }

    public static function del($key) {
       return self::getHandler()->del($key);
    }
}