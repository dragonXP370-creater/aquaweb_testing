<?php
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
    <link rel="stylesheet" href="../css/shop2.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="../css/dropdown-filter.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="icon" type="./x-icon" href="../favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php // imports header
    include('templates/header.php');
    ?>

    <?php
    // itterates through all fishes
    $statement = "SELECT * FROM fish";
    $response = mysqli_query($db_connect, $statement);
    while ($row = mysqli_fetch_assoc($response)) {
        $buy = $row["id"] . "buy";
        $price = $row["id"] . "price";
        $id = $row["id"] . "id";
        // buys new fish (reduce users balance, insert new users_fish entry)
        if (isset($_GET[$buy]) && $_GET[$buy] == 1) {
            $day_of_Purchase = date("Y-m-d H:i:s");
            $request = "SELECT position FROM users_fish WHERE users_id = " . $_SESSION['userid'] . " ORDER BY position DESC LIMIT 1";
            $result = mysqli_query($db_connect, $request);
            $row = mysqli_fetch_assoc($result);
            if (isset($row['position'])) {
                $position = $row['position'] + 1;
            } else {
                $position = 0;
            }
            $request = "INSERT INTO users_fish (users_id, position, fish_id, amount, day_of_Purchase, lastFed) VALUE (" . $_SESSION['userid'] . "," . $position . "," . $_POST[$id] . ",1, NOW(), NOW());";
            $result = mysqli_query($db_connect, $request);

            echo "<script>console.log('" . $buy . "')</script>";

            $request = "UPDATE users SET balance=balance-" . $_POST[$price] . " WHERE id = " . $_SESSION['userid'] . "";
            $result = mysqli_query($db_connect, $request);
        }
        // shows error message if fish is to expensive for the user
        if (isset($_GET[$buy]) && $_GET[$buy] == 0) {
            echo '<div class="cannotAfford"><p>You cannot afford this ' . $row["name"] . '.</p></div>';
        }
    }

    // gets balance from database
    $request = "SELECT * FROM users WHERE id =" . $_SESSION['userid'] . "";
    $result = mysqli_query($db_connect, $request);
    $row = mysqli_fetch_assoc($result);
    $balance = $row['balance'];

    // filters shown fishes;
    $namefilter = $_POST["namefilter"] ?? "";
    if (isset($_POST["pricetill"]) && $_POST["pricetill"] != "") {
        $pricetill = $_POST["pricetill"];
    } else {
        $pricetill = 2147483647;
    }
    $priceof = $_POST["priceof"] ?? 0;
    ?>

    <!--headline for the side with help of Bootstrap CSS-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Buy your favourite fish!</h1>
                <p class="lead fw-normal text-white-50 mb-0">Your account balance:<?php echo $balance; ?> $</p>
            </div>
        </div>
    </header>
    <main>


        <!--Addes the Filter-Dropdown-->
        <nav class="filter-nav">

            <label for="touch"><span class="shop-filter">Filter</span></label>
            <form id="filterform" action="#" method="POST">
                <input type="checkbox" id="touch">
                <ul class="slide">
                    <li><label for="namefilter" class="filter-label">Name:</label><label>
                            <input type="text" name="namefilter" id="namefilter">
                        </label></li>
                    <li><label for="pricetill" class="filter-label">Max price:</label><br><label>
                            <input type="number" name="pricetill" min="0" max="2147483647" id="pricetill">
                        </label></li>
                    <li><label for="priceof" class="filter-label">Min price:</label><br><label>
                            <input type="number" name="priceof" min="0" max="2147483647" id="priceof">
                        </label></li>
                    <li><button type="reset" class="btn btn-outline-dark mt-auto">Reset</button></li>
                    <li><button type="submit" class="btn btn-outline-dark mt-auto">Filter</button></li>
                </ul>
            </form>
        </nav>


        <!--addes CSS code, so all the fishes appear in boxes-->
        <section class='py-5'>
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php
                    //generates buy form for filtered fishes
                    if ($db_connect) {
                        $request = "SELECT * FROM fish";
                        $result = mysqli_query($db_connect, $request);


                        while ($row = mysqli_fetch_assoc($result)) {
                            if (str_contains($row["name"], $namefilter) && ($row["price"] <= $pricetill) && ($row["price"] >= $priceof)) { ?>

                                <!--<div class="fishdescription">-->
                                <?php
                                if ($row["price"] <= $balance) {
                                    ${"buy" . $row["id"]} = 1;
                                } else {
                                    ${"buy" . $row["id"]} = 0;
                                }
                                ?>
                                <!-- </div>-->


                                <div class="col mb-5">
                                    <div class="card h-100">
                                        <!-- Product image-->
                                        <img class="card-img-top" src='../assets/images/<?php echo $row["id"] ?>.png' alt="..." />
                                        <!-- Product details-->
                                        <div class="card-body p-4 text-secondary">
                                            <div class="text-center">
                                                <form class="buy-form" id=<?php echo $row["id"] . "formbuyfisharticle"; ?> action="?<?php echo $row['id']; ?>buy=<?php echo ${"buy" . $row["id"]} ?>" method="post">
                                                    <input type="number" id=<?php echo $row["id"] . "-id-article"; ?> name="<?php echo $row['id']; ?>id" value=<?php echo $row["id"] ?> readonly hidden>
                                                    <!-- Product name-->
                                                    <input type="text" class="name-form" id=<?php echo $row["id"] . "-name-article"; ?> name="name" value=<?php echo $row["name"] ?> readonly>
                                                    <!-- Product price-->
                                                    <input type="number" class="number-buy-form" id=<?php echo $row["id"] . "-price-article"; ?> name="<?php echo $row['id']; ?>price" value=<?php echo $row["price"] ?> readonly>

                                                    <!-- Product actions-->
                                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">

                                                        <div class="text-center"><button type="submit" id=<?php echo $row["id"] . "-buy-article"; ?> class="btn btn-outline-dark mt-auto">Buy</button></div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                    <?php }
                        }
                    }
                    ?>
                </div>
            </div>
        </section>


    </main>






    <?php // imports footer
    include('templates/footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>