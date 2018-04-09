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
   * Add a new state to the grammar
   * @param State $state
   */
  public function addState($state) {
    if(empty($this->initialState)) { $this->initialState = $this->currentState = $state->getName(); }
    $this->states[ $state->getName() ] = $state;
  }

  /**
   * Move the grammar into the next state
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
   * Check if a word is part of the grammar
   * @param  string $string
   * @return boolean
   */
  public function can($string) {
    $this->reset();
    $ok = true;
    for($i = 0; $i < strlen($string) && $ok; $i++) {
      $ok = $this->nextState($string[$i], ($i+1 == strlen($string) ? true : false) );
    }
    if($ok) return true;
    return false;
  }
  /**
   * Reset the grammar to accept a new input
   */
  private function reset() {
    $this->currentState = $this->initialState;
  }
}
