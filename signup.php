<?php
require("conn.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_SESSION["error"]) && !isset($_SESSION["userData"])) {
    unset($_SESSION["userData"]);
    unset($_SESSION["error"]);
}

if (isset($_POST["submit"]) && !empty($_POST["submit"]) && $_POST["submit"]=="Signup") {
    $error = array();
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    if ($email == "" || empty($email)) {
        $error["email"] = "Email Address is Required.";
    }
    if ($password == "" || empty($password)) {
        $error["password"] = "Password is Required.";
    }
    if ($password2 == "" || empty($password2) || $password2 != $password) {
        $error["password2"] = "Passwords Do not Match.";
    }

    if (empty($error)) {
        unset($_SESSION["userData"]);
        unset($_SESSION["error"]);
        $sql = "INSERT INTO users(email, password) VALUES ('$email', '$password')";
        $response = mysqli_query($conn, $sql);
        if(mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('User Created Successfully.')</script>";
            echo "<script>window.location.href = './login.php'</script>";
            exit();
        }else{
            echo "<script>alert('User Creation Failed')</script>";
            echo "<script>window.location.href = './signup.php'</script>";
            exit();
        }
    } else {
        $_SESSION["userData"]["email"] = $email;
        $_SESSION["userData"]["password"] = $password;
        $_SESSION["error"] = $error;
        header("Location: signup.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Signup</title>
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
                                    <h1 class="display-3">
                                        Signup
                                        <hr>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="signup.php">
                            <div class="row mb-2">
                                <div class="col">
                                    <input type="email" value="<?= isset($_SESSION["userData"]["email"]) ? $_SESSION["userData"]["email"] : ""; ?>" placeholder="Enter Email Address" class="form-control <?= !empty($_SESSION["error"]["email"]) ? 'is-invalid' : "" ?>" name="email">
                                    <?php if (!empty($_SESSION["error"]["email"])) { ?>
                                        <div class="text-danger py-1 mt-1" role="alert" style="font-size:12px;"> <?= $_SESSION["error"]["email"] ?> </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <input type="password" value="<?= isset($_SESSION["userData"]["password"]) ? $_SESSION["userData"]["password"] : ""; ?>" placeholder="Enter Password" class="form-control <?= !empty($_SESSION["error"]["password"]) ? 'is-invalid' : "" ?>" name="password">
                                    <?php if (!empty($_SESSION["error"]["password"])) { ?>
                                        <div class="text-danger py-1 mt-1" role="alert" style="font-size:12px;"> <?= $_SESSION["error"]["password"] ?> </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col">
                                    <input type="password" value="" placeholder="Confirm Password" class="form-control <?= !empty($_SESSION["error"]["password2"]) ? 'is-invalid' : "" ?>" name="password2">
                                    <?php if (!empty($_SESSION["error"]["password2"])) { ?>
                                        <div class="text-danger py-1 mt-1" role="alert" style="font-size:12px;"> <?= $_SESSION["error"]["password2"] ?> </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-2">
                                <div class="col">
                                    <input class="btn btn-primary" type="submit" style="width: 100%;" name="submit" value="Signup">
                                </div>
                                <div class="col">
                                    <a class="btn btn-outline-danger" style="width: 100%;" href="index.php">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</body>

</html>

<?php
unset($_SESSION["error"]);
unset($_SESSION["userData"]);
?>