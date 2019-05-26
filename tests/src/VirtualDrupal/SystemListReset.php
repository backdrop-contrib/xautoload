<?php


namespace Drupal\xautoload\Tests\VirtualDrupal;


class SystemListReset {

  /**
   * @var DrupalStatic
   */
  private $backdropStatic;

  /**
   * @var Cache
   */
  private $cache;

  /**
   * @param Cache $cache
   * @param DrupalStatic $backdropStatic
   */
  function __construct(Cache $cache, DrupalStatic $backdropStatic) {
    $this->cache = $cache;
    $this->backdropStatic = $backdropStatic;
  }

  /**
   * @see system_list_reset()
   */
  function systemListReset() {
    $this->backdropStatic->resetKey('system_list');
    $this->backdropStatic->resetKey('system_rebuild_module_data');
    $this->backdropStatic->resetKey('list_themes');
    $this->cache->cacheClearAll('bootstrap_modules', 'cache_bootstrap');
    $this->cache->cacheClearAll('system_list', 'cache_bootstrap');

  }
} 
