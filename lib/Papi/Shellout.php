<?php

/*
 * shellout()
 * Factory for shell commands. All arguments are added
 * to the shell command, strings are added literally and
 * arrays values are escaped for safe execution.
 *
 * shellout('ls -l', array('/bin', '/etc'))->exec();
 * shellout('ls -l', array('/bin', '/usr/sbin'))->pre()->passthru();
 */

function shellout(){
  $args = func_get_args();
  $s = new Shellout('');
  foreach ($args as $arg) {
    $s->args($arg);
  }
  return $s;
}

class Shellout {
  function __construct($cmd){
    $this->cmd = $cmd;
  }

  function exec(){
    $this->out = array();
    $this->return_val = false;
    exec($this->cmd, $this->out, $this->return_val);
    return $this;
  }

  function passthru(){
    passthru($this->cmd);
  }

  function args($args) {
    if (is_string($args)) $this->cmd .= ' '.$args;

    else if (is_array($args)){
      foreach ($args as $a) {
        $this->cmd .= ' '.escapeshellarg(escapeshellcmd($a));
      }
    }
    return $this;
  }
  function pre(){
    echo "<pre>";
    return $this;
  }
  function lines(){
    return implode("\n", $this->out);
  }
}