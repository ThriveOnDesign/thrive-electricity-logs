<?php

global $wpdb;

$electricityLogTable = $wpdb->prefix.'thrive_electricity_logs';

function thrive_write_db() {
  check_ajax_referer( 'nonce_name' );
  
  $body = $_POST['body'];

      if ( isset ( $body[0] ) ) {
        $room = $body[0]['room'];
        $userInput = $body[0]['userInput'];

        $wpdb->insert(
          $electricityLogTable,
          array(
            'room' => $room,
            'reading' => $userInput
          ),
          array(
            '%s',
            '%f'
          )
        );
      }


}
add_action( 'wp_ajax_thrive_write_db', 'thrive_write_db' );


?>