<?php

require __DIR__ . '/IHandler.php';

class RedisHandler implements IHandler {

	private $redis;

	public function __construct($ip, $port, $error_reporting) {
		if (!extension_loaded('redis') && $error_reporting) {
            throw new RuntimeException('Redis extension is not loaded');
        }

        $this->redis = new Redis();
        $result = $this->redis->connect($ip, $port);

		if (!$result && $error_reporting) {
			throw new RuntimeException('Redis connect timeout');
		}
	}

	public function set($key, $data, $ttl = -1) {
		$data = $this->serialize($data);
		if ($ttl == -1) {
			return $this->redis->set($key, $data);
		}else {
			return $this->redis->setex($key, $ttl, $data);
		}
	}

	public function get($key) {
		$data = $this->redis->get($key);
		if ($data != null) {
			$data = $this->unserialize($data);
			return $data;
		}else {
			return null;
		}
	}

	public function del($key) {
		$result = $this->redis->del($key);
        return (bool) $result;
	}

	private function serialize($data) {
        return serialize($data);
    }

    private function unserialize($data) {
        return unserialize($data);
    }
}
