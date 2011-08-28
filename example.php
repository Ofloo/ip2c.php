<?php
  // SAMPLE
  $test = new ip2c ();
  if ($test->locate ()) {
    list ($ip) = $test->address ();
    echo ($ip . "\n");
  }
  $test = null;

  $test = new ip2c ();
  if ($test->locate ("::")) {
    list ($ip) = $test->address ();
    echo ($ip . "\n");
  }
  $test = null;
?>
