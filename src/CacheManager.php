<?php

require './Handler/FileSystemManager.php';

use RuntimeException;

class CacheManager {

    private static $instance = null;

    private $handler;

    public static function getInstance() {
        if (null === self::$instance) {
            self::$instance = new self();
            // Загружаем конфиг
            include('./config.php');
            switch ($handler) {
                case 'FileSystem':
                    $handler = new FileSystem($path);
                    $this->setHandler($handler);
                    break;
                // TODO: exeption
            }
        }
        return self::$instance;
    }

    private function __clone() {}
    private function __construct() {}

    private function setHandler($handler) {
        $this->handler = $handler;
    }

    private function getHandler() {
        return $this->handler;
    }

    public function set($key, $data, $ttl = -1) {
        return $this->getHandler()->set($key, $data, $ttl);
    }

    public function get($key) {
        return $this->getHandler()->get($key);
    }

    public function del($key) {
       return $this->getHandler()->del($key);
    }
}