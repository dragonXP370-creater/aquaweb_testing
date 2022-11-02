<?php
// starts session
session_start();
$indexphp = '';
$connectionpath = $indexphp . 'database/connection.php';
include($connectionpath); 
?>
<!DOCTYPE html>
<html xml:lang="en" lang="en">

<head>
	<title>AquaWeb</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="icon" type="./x-icon" href="../favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_adminoverview.css">
</head>

<body>
    <?php // imports header
        include('templates/header.php');
    ?>

 <!--headline for the side with help of Bootstrap CSS-->
<header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Administration</h1>
                    
                </div>
            </div>
</header>
<main>

    <!--select either the adminfish-page or the adminuser-page-->
    <div class="container h-75">
        <div class="row align-middle">
            <div class="col-md-6 col-lg-4 column">
                <div class="card gr-1">
                    <div class="txt text-center">
                        <h1>Edit <br>
                            the fishes</h1>
                        <p>You can edit existing fishes or add new ones here</p>
                    </div>
                    <a href="adminfish.php">more</a>
                    <div class="ico-card">
                        <i class="fa fa-rebel"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 column">
                <div class="card gr-2">
                    <div class="txt text-center">
                        <h1>Edit <br>
                            the users</h1>
                        <p>You can edit existing users or add new ones here</p>
                    </div>
                    <a href="adminuser.php">more</a>
                    <div class="ico-card">
                        <i class="fa fa-codepen"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php // imports footer
    include('templates/footer.php');
?>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/aquariumAnimation.js"></script>

</body>
</html>
