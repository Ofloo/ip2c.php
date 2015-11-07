<?php
  /*
   * example.php
   *
   * Copyright 2011 Wouter Snels <info@ofloo.net>
   *
   * This program is free software; you can redistribute it and/or modify
   * it under the terms of the GNU General Public License as published by
   * the Free Software Foundation; either version 2 of the License, or
   * (at your option) any later version.
   *
   * This program is distributed in the hope that it will be useful,
   * but WITHOUT ANY WARRANTY; without even the implied warranty of
   * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   * GNU General Public License for more details.
   *
   * You should have received a copy of the GNU General Public License
   * along with this program; if not, write to the Free Software
   * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
   * MA 02110-1301, USA.
   *
   * GIT: https://github.com/Ofloo/ip2c.php
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
   * with argument ip2c ("::") will lookup the provided ip in this case localhost
   */

  $test = new ip2c ();
  $test->locate ("::");
  list ($ip) = $test->address ();
  list ($country) = $test->country ();
  echo ($ip . ": " . $country . "\n");
  $test = null;

?>
