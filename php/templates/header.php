<?php
//Checks Username and shows it on the right of the header
if ($db_connect && (isset($_SESSION['userid']))) {
    $request = "SELECT * FROM users WHERE id =" . $_SESSION['userid'];
    $result = mysqli_query($db_connect,$request);
    $row = mysqli_fetch_assoc($result);
    $displayedusername = $row['username'];
    $userid = $row['id'];
}

$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
if (strpos($url, "aquarium.php") !== false) {
    parse_str($url_components['query'], $params);
    $link_user_id = $params['user'];
    $statment = "SELECT * FROM users WHERE id = $link_user_id";
    $result = mysqli_query($db_connect, $statment);
    $row = mysqli_fetch_assoc($result);
    $link_user_name = $row['username'];
}
$userid ?? 0;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!--Header-->
<header>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">AquaWeb</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <?php
                    if (isset($link_user_id) && $link_user_id != $userid) { ?>
                    <li class="nav-item">
                        <p class="btn btn-secondary">Aquarium from: <?php echo $link_user_name; ?></p>
                    </li>
                    <?php }
                    if (strpos($url, "aquarium.php") !== false && $link_user_id == $userid) { ?>
                    <li class="nav-item">
                        <form action="#" method="POST">
                            <button type="submit" class="btn btn-secondary" name="feed-button" value="Feed">Feed</button>
                        </form>
                    </li>
                    <?php } ?>
                    <?php
                    if(isset($_SESSION['userid']) && $_SESSION['userid'] == 1) { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="/php/adminoverview.php">Administration</a>
                    </li>
                    <?php } ?>

                    <li class="nav-item active">
                        <a class="nav-link" href="/">Home</a>
                    </li>

                    <?php
                    if(!isset($_SESSION['userid'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/php/forms/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/php/forms/register.php">Register</a>
                    </li>
                    <?php } else { ?>
                        <li class="nav-item">
                        <a class="nav-link" href="/php/aquarium.php?user=<?php echo $_SESSION['userid'];?>">My aquarium</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/php/statistics.php">Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/php/shop.php">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/php/forms/logout.php">Log out</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="/php/userpage.php"> <?php echo $displayedusername; ?></a>
                    </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
</header>