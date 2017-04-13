<?php
  /*
   * example.php
   *
   *  Simplified BSD license
   *
   *  Copyright (c) 2017, Wouter Snels
   *  All rights reserved.
   *
   *  Redistribution and use in source and binary forms, with or without
   *  modification, are permitted provided that the following conditions are met:
   *
   *  1. Redistributions of source code must retain the above copyright notice, this
   *     list of conditions and the following disclaimer.
   *  2. Redistributions in binary form must reproduce the above copyright notice,
   *     this list of conditions and the following disclaimer in the documentation
   *     and/or other materials provided with the distribution.
   *
   *  THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
   *  ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
   *  DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
   *  WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
   *  ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
   *  (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
   *  LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
   *  ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
   *  (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
   *  SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
   *
   *  The views and conclusions contained in the software and documentation are those
   *  of the authors and should not be interpreted as representing official policies,
   *  either expressed or implied, of the FreeBSD Project.
   *
   *  GIT: https://github.com/Ofloo/ip2c.php
   *
   */

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
   * with argument ip2c ("::", true) will lookup the provided ip in this case localhost
   * last flag represents with ssl or not turned off by default
   */

  $test = new ip2c ();
  $test->locate ("::1",true);
  list ($ip) = $test->address ();
  list ($country) = $test->country ();
  echo ($ip . ": " . $country . "\n");
  $test = null;

?>
