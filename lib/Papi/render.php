<?php

function render($data) {
  header('Cache-Control: no-cache, must-revalidate');
  header('Content-type: application/json');
  if (is_object($data)) {
    $data = get_object_vars($data);
  }
  echo json_encode($data);
  die();
}

