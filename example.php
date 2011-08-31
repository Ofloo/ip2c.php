<?php
  // SAMPLE
  $test = new ip2c ();
  if ($test->locate ()) {
    list ($country) = $test->country ();
    list ($ip) = $test->address ();
    echo ($ip . " " . $country . "\n");
  }
  $test = null;

  $test = new ip2c ();
  if ($test->locate ("::")) {
    list ($country) = $test->country ();
    list ($ip) = $test->address ();
    echo ($ip . " " . $country . "\n");
  }
  $test = null;
?>
