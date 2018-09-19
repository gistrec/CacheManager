# CacheManager
Менеджер кеша. Позволяет хранить данные в формате ключ/значение.  
Для каждых данных можно установить время жизни в секундах.

## Загрузка
Используйте команду [git clone](https://git-scm.com/docs/git-clone) чтобы скачать этот проект.
```
git clone --depth=1 https://github.com/gistrec/CacheManager.git
```

## Требования
Чтобы использовать memcached и redis нужны соответствующие расширения  
PHP 5.0+

## Как использовать
Необходимо подключить CacheManager.php
```php
require_once(__DIR__ . '/CacheManager/src/CacheManager.php');
```
Дальше можно работать с менеджером кеша
```php
CacheManager::getInstance()->set($key, $data, -1);
CacheManager::getInstance()->get($key);
CacheManager::getInstance()->del($key);
```


## Место хранения
Кеш можно хранить в файловой системе, Memcached или Redis  
Настраивается в конфиге **/src/config.php**

#### Примеры настроек для каждого способа:  
1. ##### Файловая система
 ```php
 $handler = 'FileSystem';
 $cachePath = __DIR__ . '/cache/';
 ```
2. ##### Redis
 ```php
 $handler = 'Redis';
 $redis_ip   = '127.0.0.1';
 $redis_port = '6379';
 ```
3. ##### Memcached
 ```php
 $handler = 'Memcached';
 $memcached_ip   = '127.0.0.1';
 $memcached_port = '11211';
 ```


## Пример использования
Кеширование всех страниц сайта на час  
##### Содержимое файла index.php:

```php
<?php
// Если нет get-параметра no_cache
if (empty($_GET['no_cache'])) {
	require_once './CacheManager/src/CacheManager.php';

	// Получаем идентификатор страницы
	$key = md5($_SERVER['REQUEST_URI']);

	// Если страница есть в кеше
	if ($page = CacheManager::getInstance()->get($key)) {
		// Отдаем её
		die($page);
	// Если страница еще не закеширована
	}else {
		// Получаем контент страницы
	    $page = file_get_contents('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '?no_cache=true');
	    // Добавляем контент страницы в кеш
	    CacheManager::getInstance()->set($key, $page, 60 * 60);
	    // Отдаем страницу
	    die($page);
    }
}

// Ваш код...
```



## Todos
 - Добавить тесты для Redis и Memcached
