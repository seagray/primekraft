<?php
namespace app\traits;

trait CacheableModel
{
    private $_cache;

    protected function _getKey($key, callable $getterCallback)
    {
        if (!isset($this->_cache[$key])) {
            $this->_cache[$key] = $getterCallback();
        }
        return $this->_cache[$key];
    }
}