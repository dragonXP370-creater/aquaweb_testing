<?php
// starts session
session_start();
$indexphp = '';
$connectionpath = $indexphp . 'database/connection.php';
include($connectionpath); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>AquaWeb</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style_adminuser.css">
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="icon" type="./x-icon" href="../favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php // imports header
        include('templates/header.php');
    ?>

    <?php
    // adds new user if add button was hit
    if(isset($_GET["add"]) && $_GET["add"] == 1) {
        $password_hash = password_hash($_POST["addpassword"], PASSWORD_DEFAULT);
        $request = "INSERT INTO users (username, password, creation_date, balance) VALUE ('". $_POST["addusername"] ."', '". $password_hash ."', now(), " . $_POST["addbalance"] . ")";
        $result = mysqli_query($db_connect, $request);
    }

    // iterates through all users
    $statement = "SELECT * FROM users";
    $response = mysqli_query($db_connect, $statement);
    while ($row = mysqli_fetch_assoc($response)) {
        $update = $row["id"] . "update";
        $delete = $row["id"] . "delete";
        $balance = $row["id"] . "balance";
        $id = $row["id"] . "id";
        $username = $row["id"] . "username";
        $password = $row["id"] . "password";
        if (isset($_POST[$password])) {
            if ($_POST[$password] != ""){
                $password_hash = password_hash($_POST[$password], PASSWORD_DEFAULT);
            }
        }
        // updates the correct user with the new values
        if(isset($_GET[$update]) && $_GET[$update] == 1) {
            if(isset($password_hash)){
                $request = "UPDATE users SET username='". $_POST[$username] ."', password='". $password_hash ."', balance=". $_POST[$balance] ." WHERE id=". $_POST[$id] ."";
            } else {
                $request = "UPDATE users SET username='". $_POST[$username] ."', balance=". $_POST[$balance] ." WHERE id=". $_POST[$id] ."";
            }
            $result = mysqli_query($db_connect, $request);
        }

        //deletes the correct users
        if(isset($_GET[$delete]) && $_GET[$delete] == 1) {
            $request = "DELETE FROM users WHERE id=". $_POST[$id] ."";
            $result = mysqli_query($db_connect, $request);
            $request = "DELETE FROM users_fish WHERE users_id=". $_POST[$id] ."";
            $result = mysqli_query($db_connect, $request);
        }
    }
    ?>
     <!--headline for the side with help of Bootstrap CSS-->
    <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">User administration</h1>
                </div>
            </div>
        </header>
    <main>
        <!--Responsive Table with Bootstrap-->
        <div class="container-xl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Manage <b>users</b></h2>
                            </div>
                            <!--Modal for adding a new User-->
                            <div class="col-sm-6">
                                <a href="#addFisherModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Fisher</span></a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Balance</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // generates the filtered userforms
                        if ($db_connect) {
                            $request = "SELECT * FROM users";
                            $result = mysqli_query($db_connect, $request);
                            while ($row = mysqli_fetch_assoc($result)) {?>
                                <tr>
                                    <div class="fishdescription">
                                        <form id=<?php echo $row["id"] . "formupdatefisharticle"; ?> action="?<?php echo $row['id'];?>update=1" method="post">
                                            <td ><?php echo $row["id"]?></td>
                                            <td><?php echo $row["username"]?></td>
                                            <td><?php echo $row["balance"]?></td>
                                        </form>
                                    </div>
                                    <td>
                                        <a href="#editFisherModal<?php echo $row["id"];?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                        <!-- Edit Modal HTML -->
                                        <div id="editFisherModal<?php echo $row["id"];?>" class="modal fade text-primary">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form  id=<?php echo $row["id"] . "formupdatefisharticle"; ?> action="?<?php echo $row['id'];?>update=1" method="post">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Fisher</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Username</label>
                                                                <label for=name></label><input type="text" id=<?php echo $row["id"] . "username"; ?> name ="<?php echo $row['id'];?>username" value=<?php echo $row["username"]?>>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Password</label>
                                                                <label for=name></label><input type="password" id=<?php echo $row["id"] . "password"; ?> name ="<?php echo $row['id'];?>password" value="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Balance</label>
                                                                <label for=name></label><input type="number" min="0" max="9999999999" id=<?php echo $row["id"] . "balance"; ?> name ="<?php echo $row['id'];?>balance" value=<?php echo $row["balance"]?>>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <label for=name></label><input type="number" id=<?php echo $row["id"] . "-id"; ?> name ="<?php echo $row['id'];?>id" value=<?php echo $row["id"]?> readonly hidden>
                                                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                            <input type="submit" id=<?php echo $row["id"] . "update"; ?> class="btn btn-info" value="Save">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="#deleteFisherModal<?php echo $row["id"];?>" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                        <!-- Delete Modal HTML -->
                                        <div id="deleteFisherModal<?php echo $row["id"];?>" class="modal fade text-primary">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form  id=<?php echo $row["id"] . "formdeletefisharticle"; ?> action="?<?php echo $row['id'];?>delete=1" method="post">
                                                        <div class="modal-header text-primary">
                                                            <h4 class="modal-title">Delete Employee</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        </div>
                                                        <div class="modal-body text-primary">
                                                            <p>Are you sure you want to delete these Records?</p>
                                                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                                                        </div>
                                                        <div class="modal-footer text-primary">
                                                            <label for=name></label><input type="number" id=<?php echo $row["id"] . "-id"; ?> name ="<?php echo $row['id'];?>id" value=<?php echo $row["id"]?> readonly hidden>
                                                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                            <input type="submit" id=<?php echo $row["id"] . "-delete"; ?> class="btn btn-danger" value="Delete">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- AddUser Modal HTML -->
        <div id="addFisherModal" class="modal fade text-primary">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form  id="formaddfisharticle" action="?add=1" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title text-primary">Add User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="false">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group text-primary">
                                <label>Username</label>
                                <label for="addusername"></label><input id="addusername" name ="addusername" type="text" class="form-control" required>
                            </div>
                            <div class="form-group text-primary">
                                <label>Password</label>
                                <label for="addpassword"></label><input id="addpassword" name ="addpassword" type="password" class="form-control" required>
                            </div>
                            <div class="form-group text-primary">
                                <label>Balance</label>
                                <label for="addbalance"></label><input id="addbalance" name ="addbalance" type="number" class="form-control" required/>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" id="add" class="btn btn-success" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <input type="button" onclick="location.href='adminoverview.php'" class="btn btn-info" data-dismiss="modal" value="Return">
    </main>

    <?php // imports footer
        include('templates/footer.php');
    ?>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>