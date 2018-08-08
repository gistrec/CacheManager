<?php

require __DIR__ . '/IHandler.php';

class MemcachedHandler implements IHandler {

	private $memcached;

	public function __construct($ip, $port, $error_reporting = true) {
		if (!extension_loaded('memcached') && $error_reporting) {
            throw new RuntimeException('Memcached extension is not loaded');
        }

        $this->memcached = new Memcached();
        // TODO!
        // $this->memcached->setOption(Memcached::OPT_CONNECT_TIMEOUT, $aConfig['connection_timeout']);
        // $this->memcached->setOption(Memcached::OPT_DISTRIBUTION, Memcached::DISTRIBUTION_CONSISTENT);
        // $this->memcached->setOption(Memcached::OPT_SERVER_FAILURE_LIMIT, $aConfig['server_failure_limit']);
        // $this->memcached->setOption(Memcached::OPT_REMOVE_FAILED_SERVERS, $aConfig['remove_failed_servers']);
        // $this->memcached->setOption(Memcached::OPT_RETRY_TIMEOUT, $aConfig['retry_timeout']);

        $this->memcached->addServer($ip, $port);
	}

	public function set($key, $data, $ttl = -1) {
		$data = $this->serialize($data);
		return $this->memcached->set($key, $data, $ttl);
	}

	public function get($key) {
        $data = $this->memcached->get($key);
        if ($data != null) {
        	$data = $this->unserialize($data);
        	return $data;
        }else {
        	return null;
        }
	}

	public function del($key) {
		$result = $this->memcached->delete($key);
		if ($this->memcached->getResultCode() !== Memcached::RES_NOTFOUND) {
			return $result;
		}else {
			return true;
		}
	}

	private function serialize($data) {
        return serialize($data);
    }

    private function unserialize($data) {
        return unserialize($data);
    }
}