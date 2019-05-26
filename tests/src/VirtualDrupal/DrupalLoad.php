<?php


namespace Drupal\xautoload\Tests\VirtualDrupal;


class DrupalLoad {

  /**
   * @var array
   */
  private $files = array();

  /**
   * @var DrupalGetFilename
   */
  private $backdropGetFilename;

  /**
   * @param DrupalGetFilename $backdropGetFilename
   */
  function __construct(DrupalGetFilename $backdropGetFilename) {
    $this->backdropGetFilename = $backdropGetFilename;
  }

  /**
   * @see backdrop_load()
   */
  function backdropLoad($type, $name) {

    if (isset($this->files[$type][$name])) {
      return TRUE;
    }

    $filename = $this->backdropGetFilename->backdropGetFilename($type, $name);

    if ($filename) {
      include_once $filename;
      $this->files[$type][$name] = TRUE;

      return TRUE;
    }

    return FALSE;
  }
} 
