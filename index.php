<?php
session_start();
$indexphp = 'php/';
$connectionpath = $indexphp . 'database/connection.php';
include($connectionpath); 
?>
<!DOCTYPE html>
<html xml:lang="en" lang="en">

<head>
	<title>AquaWeb</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="icon" type="./x-icon" href="favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<!--Include header-->
<?php include('php/templates/header.php');?>

<main>
    <!--Carousel-->
<div id="carouselCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <!--First Item / Start Item-->
            <div class="carousel-item active" style="background-image: url('https://cdn.pixabay.com/photo/2016/11/29/09/43/koi-fish-1868779_960_720.jpg')">
                <div class="carousel-caption">
                    <h2>Welcome to AquaWeb!</h2>
                    <p>Here you can grow and care for your online aquarium</p>
                </div>
            </div>
            <!--Second Item-->
            <!--Copyright-Free Pictures-->
            <div class="carousel-item" style="background-image: url('https://cdn.pixabay.com/photo/2014/06/27/12/36/fish-378286_960_720.jpg')">
                <div class="carousel-caption">
                    <h2>Grow your aquarium</h2>
                    <p>You can feed your fish and earn money from visitors</p>
                </div>
            </div>
            <!--Third Item-->
            <div class="carousel-item" id="aquariumContainer" style="width: 100%; height: 94vh; overflow: hidden; margin: 0; background-color: #6DD6C1;">
                <div class="carousel-caption">
                    <h2>Buy new fishes</h2>
                    <p>In the shop, you can buy new fish to make your aquarium even more attractive</p>
                </div>
                <div class="fish"> <?php include('assets/images/fish.svg');?> </div>
                <div class="fish"> <?php include('assets/images/fish.svg');?> </div>
                <div class="fish"> <?php include('assets/images/fish.svg');?> </div>
                <div class="fish"> <?php include('assets/images/fish.svg');?> </div>
                <div class="fish"> <?php include('assets/images/fish.svg');?> </div>
                <div class="fish"> <?php include('assets/images/fish.svg');?> </div>
            </div>
        </div>
    <!--Prev Button-->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
    <!--Next Button-->
        <button class="carousel-control-next" type="button" data-bs-target="#carouselCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</main>
<!--Include footer-->
    <?php include('php/templates/footer.php');?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!--Implementation of our own aquariumAnimation.js-->
<script src="js/aquariumAnimation.js"></script>

</body>
</html>
