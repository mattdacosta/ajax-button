<?php
//simulate a slow server
  sleep(2);

  session_start();

  if(!isset($_SESSION['favourites'])) { $_SESSION['favourites'] = []; }

  // Check Request is an ajax request
  function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }

  if(!is_ajax_request()) { exit; }

  $raw_id = isset($_POST['id']) ? $_POST['id'] : '';

  if(preg_match("/blog-post-(\d+)/", $raw_id, $matches)) {

    $id = $matches[1];

    //
    if(!in_array($id, $_SESSION['favourites'])){
      $_SESSION['favourites'][] = $id;
    }
    //
    echo "true";
  }
  else {
    echo "false";
  }
  // echo $_POST['id'];//$raw_id;

?>
