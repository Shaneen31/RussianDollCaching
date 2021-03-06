<?php

namespace RussianDollCaching;


class Cache
{

    private $cache;

    /**
     * Cache constructor.
     * @param CacheInterface $cache
     */
    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param $keys
     * @return string
     */
    private function hashKeys($keys)
    {
        if(is_array($keys)){
            $key = [];
            foreach ($keys as $k){
                array_push($keys, $this->hashKey($k));
            }
            return implode('_', $key);
        } else {
            return $this->hashKey($keys);
        }
    }

    /**
     * @param $key
     * @return string
     */
    private function hashKey($key)
    {
        if(is_a($key, 'Illuminate\\Database\\Eloquent\\Model')) {
            return str_replace('\\', '_', get_class($key)) . "_" . $key->id . "_" . $key->updated_at->timestamp;
        } else {
        return $key;
        }
    }

    /**
     * @param $keys
     * @param callable $callback
     */
    public function cache($keys, Callable $callback)
    {
        $key = $this->hashKeys($keys);
        $value = $this->cache->get($key);
        if(!$value){
            ob_start();
            $callback();
            $value = ob_get_clean();
            $this->cache->set($key, $value);
        }
         echo  $value;
    }
}