<?php

namespace RussianDollCaching;


class Cache
{

    private $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function cache($record, Callable $callback)
    {
        if(is_a($record, 'Illuminate\\Database\\Eloquent\\Model')) {
            $record = str_replace('\\', '_', get_class($record)) . "_" . $record->id . "_" . $record->updated_at->timestamp;
        }
        $value = $this->cache->get($record);
        if(!$value){
            ob_start();
            $callback();
            $value = ob_get_clean();
            $this->cache->set($record, $value);
        }
         echo  $value;
    }
}