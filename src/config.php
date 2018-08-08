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
 * @param string $handler
 */
$handler = 'FileSystem';

// Для FileSystem
$cachePath = __DIR__ . '/cache/';