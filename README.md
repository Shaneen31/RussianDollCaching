# Russian Doll Caching (Fragmented Caching)
Version 0.2.0

### Main Features ###
- Allow caching fragment of pages.
- Cache single objects.
- Cache one big object made of smaller ones (Cascade Caching).
- Cache on disk.

### How To Use ###

#### Cache using disk ####
Example to cache posts with Laravel.

Cache single object

In your view

```php

<?php
use RussianDollCaching\Cache;
use RussianDollCaching\DiskCache;

$cache = new Cache(new DiskCache());
?>
<?php foreach($posts->get() as $post): ?>
    <?php $cache->cache($post, function() use ($post){ ?>
        some code
    <?php }); ?>
<?php endforeach; ?>

```

Cascade Caching

In your model

```php

public static function lastUpdated(){
        return self::orderBy('updated_at', 'DEST')->select('id', 'updated_at')->first();
    }
    
```

In your view

```php

<?php
use RussianDollCaching\Cache;
use RussianDollCaching\DiskCache;

$cache = new Cache(new DiskCache());
?>

<?php $cache->cache(['posts', \App\Post::lastUpdated()], function() use ($cache, $posts){   ?>
    <?php foreach($posts->get() as $post): ?>
        <?php $cache->cache($post, function() use ($post){ ?>
            some code
        <?php }); ?>
    <?php endforeach; ?>
<?php }); ?>

```

#### Cache using redis ####
Example to cache posts with Laravel.

Cache single object

In your view

```php

<?php
use RussianDollCaching\Cache;
use RussianDollCaching\RedisCache;

$cache = new Cache(new RedisCache());
?>
<?php foreach($posts->get() as $post): ?>
    <?php $cache->cache($post, function() use ($post){ ?>
        some code
    <?php }); ?>
<?php endforeach; ?>

```

Cascade Caching

In your model

```php

public static function lastUpdated(){
        return self::orderBy('updated_at', 'DEST')->select('id', 'updated_at')->first();
    }
    
```

In your view

```php

<?php
use RussianDollCaching\Cache;
use RussianDollCaching\RedisCache;

$cache = new Cache(new RedisCache());
?>
<?php $cache->cache(['posts', \App\Post::lastUpdated()], function() use ($cache, $posts){   ?>
    <?php foreach($posts->get() as $post): ?>
        <?php $cache->cache($post, function() use ($post){ ?>
            some code
        <?php }); ?>
    <?php endforeach; ?>
<?php }); ?>

```

### License ###
The code for RussianDollCaching is distributed under the terms of the GNU/GPL V3 license (see [LICENSE](LICENSE)).
