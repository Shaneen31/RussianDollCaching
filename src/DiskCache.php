<?php

namespace RussianDollCaching;

class DiskCache implements CacheInterface
{

    /**
     * @param $key
     * @return string
     */
    private  function getFilePath($key)
    {
        return __DIR__ . '/cache/' . $key;
    }

    /**
     * @param $key
     * @return bool|string
     */
    public function get($key)
    {
        if(file_exists($this->getFilePath($key))) {
            return file_get_contents($this->getFilePath($key));
        } else {
            return false;
        }
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        file_put_contents($this->getFilePath($key), $value);
    }
}