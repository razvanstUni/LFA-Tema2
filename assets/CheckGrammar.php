<?php
/**
 *
 */
class CheckGrammar
{
  private $words;
  private $states;

  /**
   * [__construct description]
   * @param object $input input data for the grammar
   */
  function __construct($input) {
    if(!isset($input) || empty($input)) return;
    $this->words = $input->words;
    $this->states = $input->states;
  }

  /**
   * [run description]
   * @return array accepted and rejected words
   */
  public function run() {
    $gr = new Grammar( $this->states );
    $accepted = array(); $refected = array();
    foreach ($this->words as $word) {
          if( $gr->can( $word ) ) $accepted[] = $word;
          else $rejected[] = $word;
    }
    return array( 'accepted_words' => $accepted,
                  'rejected_words' => $rejected);
  }
}
