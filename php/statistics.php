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
    <link rel="stylesheet" href="../css/style.css">
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
    <!--headline for the side with help of Bootstrap CSS-->
     <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Statistics</h1>
                </div>
            </div>
        </header>

    <main>
        <!--Addes the Sorting-Dropdown-->
            <aside class="filterside">
                <nav class="filter-nav">
                    <label for="touch"><span class="statistic-filter">Sort</span></label>
                    <!--Form-element with radioButtons for sorting the fishes in your aquarium-->
                    <form class="sql_sort" method="post" id="filterform" action="#">
                        <input type="checkbox" id="touch">
                        <ul class="slideStatistic">
                            <li><label class="filter-label">Name:</label><br><label for="sort1"></label><input type="radio" name="sortingOption" value="sortByName" id="sort1"></li>
                            <li><label class="filter-label">Price:</label><br><label for="sort2"></label><input type="radio" id="sort2" name="sortingOption" value="sortByPrice"></li>
                            <li><label class="filter-label">Purchase time:</label><br><label for="sort3"></label><input type="radio" id="sort3" name="sortingOption" value="sortByPurchaseTime"></li>
                            <li><button type="submit" class="btn btn-outline-dark mt-auto">Sort</button></li>
                        </ul>
                    </form>
                </nav>
            </aside>

        <?php


        //get the sortingOption from the Form-element
        $sortingOption = $_POST["sortingOption"] ?? "";

        //get the user_id from the session
        $userid = $_SESSION['userid'];


        //switch case block with different sql-queries depending on your sortingOption
        switch ($sortingOption) {
            case "sortByName":
                $abfrage = "SELECT fish.name, fish.price, users_fish.amount, users_fish.day_of_Purchase, users_fish.lastFed 
            FROM users_fish
            INNER JOIN fish ON fish.id = users_fish.fish_id
            WHERE users_fish.users_id = $userid
            ORDER BY fish.name";
                break;
            case "sortByPrice":
                $abfrage = "SELECT fish.name, fish.price, users_fish.amount, users_fish.day_of_Purchase, users_fish.lastFed 
            FROM users_fish
            INNER JOIN fish ON fish.id = users_fish.fish_id
            WHERE users_fish.users_id = $userid
            ORDER BY fish.price";
                break;
            case "sortByPurchaseTime":
                $abfrage = "SELECT fish.name, fish.price, users_fish.amount, users_fish.day_of_Purchase, users_fish.lastFed 
            FROM users_fish
            INNER JOIN fish ON fish.id = users_fish.fish_id
            WHERE users_fish.users_id = $userid
            ORDER BY users_fish.day_of_Purchase";
                break;
            default:
                $abfrage = "SELECT fish.name, fish.price, users_fish.amount, users_fish.day_of_Purchase, users_fish.lastFed 
            FROM users_fish
            INNER JOIN fish ON fish.id = users_fish.fish_id
            WHERE users_fish.users_id = $userid";
                break;
        }

        //stores the result of sql-query in variable
        $result = mysqli_query($db_connect, $abfrage);

        //generates on output-table for the sql-query
        echo "<section>";
        echo "<div class='container'>";
        echo "<div class='row'>";
        echo "<div class='col-md-offset-1 col-md-10'>";
        echo "<div class='panel'>";
        echo "<div class='panel-body table-responsive'>";
        echo "<table class='table'>
            <thead>
            <tr>
                <th>name</th>
                <th>price</th>
                <th>purchased at</th>
                <th>last fed at</th>
            </tr>
            </thead>";

        echo "<tbody>";

        //insert the result-variable into the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "<td>" . $row["day_of_Purchase"] . "</td>";
            echo "<td>" . $row["lastFed"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</section>";
        ?>

    </main>

    <br>

    <?php // imports footer
    include('templates/footer.php');
    ?>
</body>

</html>