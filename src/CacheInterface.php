<?php

namespace RussianDollCaching;


interface CacheInterface
{

    public function get($key);

    public function set($key, $value);
}