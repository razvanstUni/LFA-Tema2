<?php
function __autoload($class_name) {
  require_once './assets/' . $class_name . '.php';
}

/*
  Dummy example
 */
$gr = new Grammar;
$words = array('ab', 'ac', 'b', 'bcc', 'abbc');

$gr->addState( new State("S", array('aS', 'bA')) );
$gr->addState( new State("A", array('0', 'cA')) );

foreach ($words as $word) {
      print $word . ( $gr->can( $word ) ? ' - DA' : ' - NU' ) . '<br />';
}
