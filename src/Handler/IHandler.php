<?php

interface IHandler {

	/**
     * Добавление данных
     * @param string $key
     * @param mixed $data
     * @param int $ttl Время жизни данных
     * @return mixed Возвращает NULL при неудаче, или хранимые данные
     */
	public function set($key, $data, $ttl = -1);

	/**
     * Удаление данных
     * @param string $key
     * @return mixed Возвращает NULL при неудаче, или хранимые данные
     */
	public function get($key);

	/**
     * Удаление данных
     * @param string $key
     * @return bool Возвращает TRUE при успехе, иначе FALSE
     */
	public function del($key);
}