<?php
/**
 *
 */
class State
{
  private $name;
  private $path = array();
  /**
   * [__construct description]
   * @param string $name State label
   * @param array $path
   */
  function __construct($name, $path)
  {
    $this->name = $name;
    $this->path = $path;
  }
  /**
   * [getName description]
   * @return string
   */
  public function getName() {
    return $this->name;
  }
  /**
   * [getPath description]
   * @return array
   */
  public function getPath() {
    return $this->path;
  }
}
