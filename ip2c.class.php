<?php
/*
 *      ip2c.class.php
 *
 *      Copyright 2011 Wouter Snels <info@ofloo.net>
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

  class ip2c {

    private $_ADDRESS;
    private $_ABBR_SHORT;
    private $_ABBR_LONG;
    private $_COUNTRY;
    private $_REGISTRY;
    private $_ASSIGNED;

    // locate ip input ip returns true or false
    public function locate ($ip = null) {
      $url = "http://api.ip2c.info/csv/" . $ip;
      while (1) {
        if ($meta = get_headers ($url, 1)) {
          if (isset ($meta['Location'])) {
            $url = $meta['Location'];
            continue;
          }
          if (isset ($meta['Content-Length'])) {
            $bytes = $meta['Content-Length'];
            break;
          } else {
            $bytes = 1024;
            break;
          }
        } else {
          $bytes = 1024;
          break;
        }
      }
      if ($http = fopen ($url, "r")) {
        $i = 0;
        while (!feof ($http)) {
          list (
            $this->_ADDRESS[$i],
            $this->_ABBR_SHORT[$i],
            $this->_ABBR_LONG[$i],
            $this->_COUNTRY[$i],
            $this->_REGISTRY[$i],
            $this->_ASSIGNED[$i]
          ) = fgetcsv ($http, $bytes, ',', '"');
          $i++;
        }
        fclose ($http);
        if (sizeof ($this->_ADDRESS)) {
          return true;
        }
      }
      return false;
    }

    // returns type array ip wich was looked up
    public function address () {
      return $this->_ADDRESS;
    }

    // returns type array 2 char abbreveration
    public function abbr_short () {
      return $this->_ABBR_SHORT;
    }

    // returns type array 3 char abbreveration
    public function abbr_long () {
      return $this->_ABBR_LONG;
    }

    // returns type array full country name
    public function country () {
      return $this->_COUNTRY;
    }

    // returns type array registry where the ip was allocated
    public function registry () {
      return $this->_REGISTRY;
    }

    // returns type array when the ip was allocated
    public function assigned () {
      return $this->_ASSIGNED;
    }

    public function __destruct () {
      unset ($_ADDRESS);
      unset ($_REGISTRY);
      unset ($_ABBR_SHORT);
      unset ($_ABBR_LONG);
      unset ($_ASSIGNED);
      unset ($_COUNTRY);
      foreach(get_object_vars($this) as $k => $v) {
        unset($this->$k);
      }
    }

  }

?>
