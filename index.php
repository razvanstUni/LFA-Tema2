<?php
define("DEBUG", false);
function __autoload($class_name) {
  require_once './assets/' . $class_name . '.php';
}

$gr = new Grammar;

$gr->addState( new State("S", array('aS', 'bA')) );
$gr->addState( new State("A", array('0', 'cA')) );

if(DEBUG) {
  print '<pre>';
  var_dump($gr);
  print '</pre>';
  exit;
}

if( $gr->can("ab") ) print "DA"; else print "NU";
