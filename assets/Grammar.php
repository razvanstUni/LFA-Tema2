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
   * Set the grammar
   * @param array $states
   */
  function __construct($states) {
    if(!isset($states) || empty($states)) return;
    foreach ($states as $state) {
      $this->addState( new State($state->name, $state->path) );
    }
  }

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
  public function can($string, $doReset = true) {
    if($doReset) $this->reset();
    $ok = true;
    for($i = 0; $i < strlen($string) && $ok; $i++) {
      $hasMultiplePaths = $this->states[ $this->currentState ]->hasMultiplePaths( $string[ $i ] );
      if( $hasMultiplePaths === false )
        $ok = $this->nextState($string[$i], ($i+1 == strlen($string) ? true : false) );
      else {
        foreach ($hasMultiplePaths as $path) {
          $grammar = clone $this;
          $grammar->setCurrentState( $path[1] );
          $ok = $grammar->can( substr($string, $i+1), false );
          if( $ok ) return true;
        }
        return false;
      }
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
  /**
   * [setCurrentState description]
   * @param char $state 
   */
  public function setCurrentState( $state ) {
    $this->currentState = $state;
  }
}
