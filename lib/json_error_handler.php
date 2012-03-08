<?php

/*
 * JSON friendly error output
 */

error_reporting(E_ALL);

function error_handler($level,$message,$file,$line,$context){
  $output = array('level'=>$level, 'message'=>$message, 'file'=>$file, 'line'=>$line);
  render(array('error'=>$output));
}

set_error_handler("error_handler");