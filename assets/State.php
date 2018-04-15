<?php
/**
 *
 */
class State
{
  private $name;
  private $path = array();
  /**
   * @param string $name State label
   * @param array $path
   */
  function __construct($name, $path)
  {
    $this->name = $name;
    $this->path = $path;
  }
  /**
   * Get the label of the state
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

  /**
   * [hasMultiplePaths description]
   * @param  char  $char
   * @return mixt returns false or array
   */
  public function hasMultiplePaths($char) {
    $letters = array();
    foreach ($this->path as $letter) {
      if( $letter[0] == $char && strlen($letter) == 2 ) $letters[] = $letter;
    }
    if( count($letters) <= 1 ) return false;
    else return $letters;
  }
}
