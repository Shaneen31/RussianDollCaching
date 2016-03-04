<?php

namespace RussianDollCaching;

class DiskCache implements CacheInterface
{

    private  function getFilePath($key)
    {
        return __DIR__ . '/cache/' . $key;
    }

    public function get($key)
    {
        if(file_exists($this->getFilePath($key))) {
            return file_get_contents($this->getFilePath($key));
        } else {
            return false;
        }
    }

    public function set($key, $value)
    {
        file_put_contents($this->getFilePath($key), $value);
    }
}