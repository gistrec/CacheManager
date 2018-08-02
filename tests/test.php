<?php

require __DIR__ . '/../src/CacheManager.php';


CacheManager::getInstance()->set("first", "data", -1);
assert(CacheManager::getInstance()->get("first") ==="data");

CacheManager::getInstance()->del("first");
assert(CacheManager::getInstance()->get("first") === NULL);

$arr = array('test1' => 1, 'test2' => array('test3', 4));
// Добавляем кеш на две секунды
CacheManager::getInstance()->set("second", $arr, 2);
assert(CacheManager::getInstance()->get("second") === $arr);

echo 'Wait 3 sec...' . PHP_EOL;
sleep(3);
assert(CacheManager::getInstance()->get("second") === NULL);

assert(CacheManager::getInstance()->del("second") === FALSE);