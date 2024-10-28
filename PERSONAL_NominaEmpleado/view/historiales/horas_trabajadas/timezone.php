<?php
$timezone = 'America/El_Salvador';
date_default_timezone_set($timezone);

function get_current_time() {
  $currentTime = date('h:i:s A'); // Adjust format as needed
  return $currentTime;
}