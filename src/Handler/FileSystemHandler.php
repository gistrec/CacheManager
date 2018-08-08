<?php

require __DIR__ . '/IHandler.php';

class FileSystemHandler implements IHandler {

	private $path;

	public function __construct($path) {
		// Добавляем слеш в конце пути, если его нет
		if ($path[strlen($path) - 1] != '/') {
			$path .= '/';
		}
		$this->path = $path;
	}

	public function set($key, $data, $ttl = -1) {
		$cacheFile = $this->path . md5($key) . '.cache';
		$timeFile  = $this->path . md5($key) . '.time';

		if ($ttl == -1) {
			$ttl = PHP_INT_MAX;
		}else {
			$ttl = time() + $ttl;
		}
		$data = $this->serialize($data);
		file_put_contents($cacheFile, $data);
		file_put_contents($timeFile,  $ttl);
	}

	public function get($key) {
		$cacheFile = $this->path . md5($key) . '.cache';
		$timeFile  = $this->path . md5($key) . '.time';

		if (file_exists($cacheFile) && file_exists($timeFile)) {
			$ttl = file_get_contents($timeFile);
			// Проверяем акутальность данных
			if ($ttl < time()) {
				$this->del($key);
				return NULL;
			}else {

				$data = file_get_contents($cacheFile);
				$data = $this->unserialize($data);
				return $data;
			}
		}else {
			return NULL;
		}
	}

	public function del($key) {
		$cacheFile = $this->path . md5($key) . '.cache';
		$timeFile  = $this->path . md5($key) . '.time';

		if (file_exists($cacheFile)) {
			unlink($cacheFile);
			unlink($timeFile);
			return true;
		}else {
			return false;
		}
	}

	private function serialize($data) {
        return serialize($data);
    }

    private function unserialize($data) {
        return unserialize($data);
    }
}