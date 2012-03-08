<?php
/*
 * Request
 * Represents the variables passed from the client
 * via get or post
 */

class Request {
  /*
   * Request() takes a list of allowable GET parameters
   * and attaches them as instance variables
   */
  function __construct($args, $method='get'){
    
    $user_args = ($method == 'post') ? $_POST : $_GET;
    
    foreach ($args as $arg) {
      if ( isset($user_args[$arg]) ) {
        $this->$arg = urldecode( $user_args[$arg] );
      } else {
        $this->$arg = false;
      }
      
    }

  }
}
