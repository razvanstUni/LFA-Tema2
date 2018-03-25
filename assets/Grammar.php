<?php
/**
 *
 */
class Grammar
{
  private $states;
  private $currentState = "";
  private $initialState = "";

  /**
   * [addState description]
   * @param State $state
   */
  public function addState($state) {
    if(empty($this->initialState)) { $this->initialState = $this->currentState = $state->getName(); }
    $this->states[ $state->getName() ] = $state;
  }

  /**
   * [nextState description]
   * @param  char  $char
   * @param  boolean $isLastChar
   * @return boolean
   */
  public function nextState($char, $isLastChar) {
    $arrTmp = $this->states[ $this->currentState ]->getPath();
    foreach ($arrTmp as $path) {
      if( strlen($path) == 2 && $path[0] == $char ) {
        $this->currentState = $this->states[ $path[1] ]->getName();
        return true;
      }
    }
    if($isLastChar) {
      foreach ($arrTmp as $path) {
        if( $path[0] == $char || $path == '0') {
          return true;
        }
      }
    }
    return false;
  }

  /**
   * [can description]
   * @param  string $string
   * @return boolean    
   */
  public function can($string) {
    $ok = true;
    for($i = 0; $i < strlen($string) && $ok; $i++) {
      $ok = $this->nextState($string[$i], ($i+1 == strlen($string) ? true : false) );
      print_r($this->currentState); print "$ok <br />";
    }
    if($ok) return true;
    return false;
  }
}
