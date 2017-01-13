<?php

  session_start();

  if(!isset($_SESSION['favourites'])) { $_SESSION['favourites'] = []; }

  // Check Request is an ajax request
  function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }

  if(!is_ajax_request()) { exit; }

?>
