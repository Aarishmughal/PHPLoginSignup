<?php
session_start();
if(empty($_SESSION["user"])){
    echo "ACCESS DENIED!";
    exit;
}
if(isset($_POST["submit"]) && !empty($_POST["submit"]) && $_POST["submit"]=="Logout"){
    session_destroy();
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>User</title>
</head>

<body>
    <div class="row d-flex content-align-center align-items-center vh-100">
        <div class="col"></div>
        <div class="col">
            <div class="card p-3">
                <div class="row">
                    <div class="col">
                        <div class="row mb-2">
                            <div class="col">
                                <div class="card-title">
                                    <h1 class="display-5">
                                        User Logged In
                                        <hr>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <div class="card-items">
                                    <h3 class="display-5">Moon, <?= $_SESSION["user"]["email"] ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card-items">
                                    <form action="user.php" method="post">
                                        <input type="submit" value="Logout" name="submit" class="btn btn-danger" style="width: 100%;">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</body>

</html>