<?php
session_start();
$indexphp = '';
$connectionpath = $indexphp . 'database/connection.php';
include($connectionpath); 

// a function to convert IPv6 to integers to store in the DB
function ip2long_v6($ip) {
    $ip_n = inet_pton($ip);
    $bin = '';
    for ($bit = strlen($ip_n) - 1; $bit >= 0; $bit--) {
        $bin = sprintf('%08b', ord($ip_n[$bit])) . $bin;
    }

    if (function_exists('gmp_init')) {
        return gmp_strval(gmp_init($bin, 2), 10);
    } elseif (function_exists('bcadd')) {
        $dec = '0';
        for ($i = 0; $i < strlen($bin); $i++) {
            $dec = bcmul($dec, '2', 0);
            $dec = bcadd($dec, $bin[$i], 0);
        }
        return $dec;
    } else {
        trigger_error('GMP or BCMATH extension not installed!', E_USER_ERROR);
    }
}

// get the visitor's IP
$ip = $_SERVER['REMOTE_ADDR'];

// check if it's IPv4, IPv6 or invalid
if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
    $ip_num = ip2long($ip);
}
else if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
    $ip_num = ip2long_v6($ip);
}
else {
    $ip_num = 0;
}

// parse user ID from link
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
$link_user_id = $params['user'];
?>


<!DOCTYPE html>
<html xml:lang="en" lang="en">

<head>
	<title>AquaWeb</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="icon" type="./x-icon" href="../favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<?php include('templates/header.php');?>

<?php
// upon pressing the Feed button, all fish are fed and 10 money is substracted from user balance
if(array_key_exists('feed-button', $_POST)) {
    $query = "UPDATE users SET balance = balance - 10 WHERE id=$link_user_id";
    $result = mysqli_query($db_connect, $query);
    $query = "UPDATE users_fish SET lastFed = NOW() WHERE users_fish.users_id = $link_user_id";
    $result = mysqli_query($db_connect, $query);
}

// if IP is valid, query if it has already visited this aquarium in the last hour
if ($ip_num !== 0) {
    $query = "SELECT * FROM users_visitors WHERE user_id = $link_user_id AND ip = $ip_num";
    $result = mysqli_query($db_connect, $query);

    // if query results in mysql error, print it
    if (!$result) {
        die(mysqli_error($db_connect));
    }
    // if IP hasn't visited in the last hour, add money to the user and log the visit
    if (mysqli_num_rows($result) < 1)
    {
        $request = "UPDATE users SET balance = balance + 50 WHERE id=$link_user_id";
        $result = mysqli_query($db_connect, $request);
        $query = "INSERT INTO users_visitors (user_id, ip) VALUES ($link_user_id, $ip_num)";
        $result = mysqli_query($db_connect, $query);

        // if query results in mysql error, print it
        if (!$result) {
            die(mysqli_error($db_connect));
        }
    }
}
?>

<main>
<div id="aquariumContainer">
    <?php
        // if user ID is alright, load the fish for that user
        if (isset($link_user_id) && $link_user_id !== "")
        {
            $query = "SELECT * FROM users_fish WHERE users_id = $link_user_id";
            $result = mysqli_query($db_connect, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $imgurl = '../assets/images/' . $row['fish_id'] . '.png';
                echo '<div class="fish">';
                echo '<img src="' . $imgurl . '" alt="some fish">';
                echo '</div>';
            }
        }
        else
        {
            // if user ID is wrong or doesn't exist, load a single .svg fish
            echo '<div class="fish">';
            include('../assets/images/fish.svg');
            echo '</div>';
        }
    ?>
    
</div>
</main>

<?php include('templates/footer.php');?>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="../js/aquariumAnimation.js"></script>

</body>
</html>
