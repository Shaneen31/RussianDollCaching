<?php

namespace RussianDollCaching;


use Predis\Client;

class RedisCache implements CacheInterface
{
    /**
     * @var Client
     */
    private $redis;

    /**
     * RedisCache constructor.
     */
    public function __construct()
    {
        $this->redis= new  Client();
    }

    /**
     * @param $key
     * @return string
     */
    public function get($key)
    {
        return $this->redis->get($key);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value)
    {
        return $this->redis->set($key, $value);
    }
}