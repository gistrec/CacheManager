<?php

/**
 * Выбрасывать ли исключение при ошибке
 * Например при неудачной авторизации
 * @param bool $error_reporting  
 */
$error_reporting = true;

/**
 * Доступные способы хранения:
 * 1. FileSystem
 * 2. Redis
 * 3. Memcached
 * @param string $handler
 */
$handler = 'FileSystem';


// Для FileSystem
$cachePath = __DIR__ . '/cache/';


// Для Redis
$redis_ip   = '127.0.0.1';
$redis_port = '6379';


// Для Memcached
$memcached_ip   = '127.0.0.1';
$memcached_port = '11211';