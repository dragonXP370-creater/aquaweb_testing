<?php
// this script must be executed every minute
// windows: use scheduled tasks
// linux: use crontab
include('database/connection.php');
// delete all visiting IPs after 2 hours
$visitor_query = "DELETE FROM users_visitors WHERE last_visit < (NOW() - INTERVAL 2 HOUR)";
$visitor_result = mysqli_query($db_connect, $visitor_query);
echo $visitor_result;

// delete all fish who haven't been fed in the last 3 days
$dead_fish_query = "DELETE FROM users_fish WHERE lastFed < (NOW() - INTERVAL 3 DAY)";
$dead_fish_result = mysqli_query($db_connect, $dead_fish_query);

echo $dead_fish_result;
?>