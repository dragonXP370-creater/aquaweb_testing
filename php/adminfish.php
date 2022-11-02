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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style_adminuser.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="../css/dropdown-filter.css">
</head>

<body>
    <?php // imports header
    include('templates/header.php');
    ?>

    <?php
    // adds ne fish if add button was hit
    if (isset($_GET["add"]) && $_GET["add"] == 1) {
        $request = "INSERT INTO fish (name, price) VALUE ('" . $_POST["addname"] . "', " . $_POST["addprice"] . ")";
        $result = mysqli_query($db_connect, $request);
    }

    // iterates through all fishes
    $statement = "SELECT * FROM fish";
    $response = mysqli_query($db_connect, $statement);
    while ($row = mysqli_fetch_assoc($response)) {
        $update = $row["id"] . "update";
        $delete = $row["id"] . "delete";
        $price = $row["id"] . "price";
        $id = $row["id"] . "id";
        $name = $row["id"] . "name";
        // updates the correct fish with the new values
        if (isset($_GET[$update]) && $_GET[$update] == 1) {
            $request = "UPDATE fish SET name='" . $_POST[$name] . "', price=" . $_POST[$price] . " WHERE id=" . $_POST[$id] . "";
            $result = mysqli_query($db_connect, $request);
        }
        //deletes the correct fish
        if (isset($_GET[$delete]) && $_GET[$delete] == 1) {
            $request = "DELETE FROM fish WHERE id=" . $_POST[$id] . "";
            $result = mysqli_query($db_connect, $request);
        }
    }
    // filters the shown fishes
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
                <h1 class="display-4 fw-bolder">Fish administration</h1>
            </div>
        </div>
    </header>

    <main>
        <!--Addes the "Add New Fish Button"-->
        <a href="#addFishModal" class="btn btn-success newFish" style="display: block; width: 160px; margin: 40px auto;" data-toggle="modal">
            <i class="material-icons">&#xE147;</i>
            <span>Add New Fish</span>
        </a>

        <!--Addes the Filter-Dropdown-->

        <nav class="filter-nav">
            <label for="touch" style="margin: 0px;"><span class="shop-filter">Filter</span></label>
            <form id="filterform" action="#" method="POST">
                <input type="checkbox" id="touch">
                <ul class="slide">
                    <li><label class="filter-label">Name:</label><br><label>
                            <input type="text" name="namefilter">
                        </label></li>
                    <li><label class="filter-label">Max price:</label><br><label>
                            <input type="number" name="pricetill" min="0" max="2147483647">
                        </label></li>
                    <li><label class="filter-label">Min price:</label><br><label>
                            <input type="number" name="priceof" min="0" max="2147483647">
                        </label></li>
                    <li><button type="reset" class="btn btn-outline-dark mt-auto">Reset</button></li>
                    <li><button type="submit" class="btn btn-outline-dark mt-auto">Filter</button></li>
                </ul>
            </form>
        </nav>


        <!--Form for add new fish-->
        <form id="formaddfisharticle1" action="?add=1" method="post">
            <ul>
                <li><input type="text" id="addname1" name="addname" hidden></li>
                <li><input type="number" id="addprice1" name="addprice" hidden></li>
                <li><button type="submit" id="add1" class="btn btn-outline-dark mt-auto" hidden>Add</button></li>
            </ul>
        </form>

        <!-- AddFishModal HTML -->
        <div id="addFishModal" class="modal fade text-primary right-side">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formaddfisharticle" action="?add=1" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title text-primary">Add Fish</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="false">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group text-primary">
                                <label for="addname" class="filter-label">Name</label>
                                <input type="text" id="addname" name="addname">
                            </div>
                            <div class="form-group text-primary">
                                <label for="addprice" class="filter-label">Price</label>
                                <input type="number" id="addprice" name="addprice">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

                            <button type="submit" id="add" class="btn btn-success">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


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


                                <div class="col mb-5">
                                    <div class="card h-100">
                                        <!-- Product image-->
                                        <img class="card-img-top" src='../assets/images/<?php echo $row["id"] ?>.png' alt="..." />
                                        <!-- Product details-->
                                        <div class="card-body p-4 text-secondary">
                                            <div class="text-center">
                                                <form id=<?php echo $row["id"] . "formupdatefisharticle"; ?> action="?<?php echo $row['id']; ?>update=1" method="post">
                                                   <input type="number" id=<?php echo $row["id"] . "-id-article"; ?> name="<?php echo $row['id']; ?>id" value=<?php echo $row["id"] ?> readonly hidden>
                                                    <!-- Product name-->
                                                    <input type="text" class="name-form" id=<?php echo $row["id"] . "-name"; ?> name="<?php echo $row['id']; ?>name" value=<?php echo $row["name"] ?>>
                                                    <!-- Product price-->
                                                   <input type="number" class="number-buy-form" id=<?php echo $row["id"] . "-price"; ?> name="<?php echo $row['id']; ?>price" value=<?php echo $row["price"] ?>>
                                                   </form>
                                                    <!-- Product actions-->
                                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                        <div class="text-center"><button type="submit" id=<?php echo $row["id"] . "-update"; ?> class="btn btn-outline-dark mt-auto">Update</button>

                                                
                                                <form id=<?php echo $row["id"] . "formdeletefisharticle"; ?> action="?<?php echo $row['id']; ?>delete=1" method="post">
                                                    <label hidden>ID:</label>
                                                    <input type="number" id=<?php echo $row["id"] . "-id"; ?> name="<?php echo $row['id']; ?>id" value=<?php echo $row["id"] ?> readonly hidden>
                                                    <button type="submit" id=<?php echo $row["id"] . "-delete"; ?> class="btn btn-outline-dark mt-2">Delete</button>
                                                </form>

                                            </div>
                                        </div>
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
        <input type="button" onclick="location.href='adminoverview.php'" class="btn btn-info" data-dismiss="modal" value="Return">
    </main>

    <?php // imports footer
    include('templates/footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>