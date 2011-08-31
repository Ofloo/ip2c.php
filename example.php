<?php

  /*
   * Sample code
   */

  require_once ("ip2c.class.php");


  /*
   * leaving ip2c () emtpy will make it look up the ip that connects to the webserver
   */

  $test = new ip2c ();
  $test->locate ();
  list ($ip) = $test->address ();
  list ($country) = $test->country ();
  echo ($ip . ": " . $country . "\n");
  $test = null;

  /*
   * leaving ip2c ("::") lookup on localhost
   */

  $test = new ip2c ();
  $test->locate ("::");
  list ($ip) = $test->address ();
  list ($country) = $test->country ();
  echo ($ip . ": " . $country . "\n");
  $test = null;

?>
