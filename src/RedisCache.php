<?php

namespace RussianDollCaching;


use Predis\Client;

class RedisCache implements CacheInterface
{
    private $redis;

    public function __construct()
    {
        $this->redis= new  Client();
    }

    public function get($key)
    {
        return $this->redis->get($key);
    }

    public function set($key, $value)
    {
        return $this->redis->set($key, $value);
    }
}