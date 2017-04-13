<?php
  /*
   * ip2c.class.php
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

  class ip2c {

    private $_ADDRESS;
    private $_ABBR_SHORT;
    private $_ABBR_LONG;
    private $_COUNTRY;
    private $_REGISTRY;
    private $_ASSIGNED;

    // locate ip input ip returns true or false
    public function locate ($ip = null, $secure = false) {
      if ( $secure ) {
        $url = "https://api.ip2c.info/csv/" . $ip;
      } else {
        $url = "http://api.ip2c.info/csv/" . $ip;
      }
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
