<?php
    session_start();
    include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FishBook Create Account</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./favicon_io/favicon.ico" type="image/x-icon">
</head>
<body class="grid place-content-center white fill-white font-mono">
    <div class=" bg-white grid place-content-center min-h-screen ">
        <div class="container mx-auto text-blue-500 text-center text-md font-black leading-loose">
            Welcome lets set your account
        </div>
        <div class="form-wrapper bg-white w-72 h-72 grid place-content-center rounded-lg shadow-2xl border-2 border-slate-500">
            <form action="" method="post">
                <div class="form-content space-y-5">
                    <div class="username-field">
                        <input class="border-2 border-blue-600 ps-3 h-10 rounded-md placeholder:ps-1"  type="text" name="username" id="inputField" placeholder="Username">
                    </div>
                    <div class="password-field">
                        <input class=" border-2 border-blue-600 ps-3 h-10 rounded-md placeholder:ps-1"  type="password" name="password" id="inputField" placeholder="Password">
                    </div>
                    <div class="grid place-content-center gap-2">
                        <button class="font-semibold bg-blue-500 p-2 max-w-full hover:bg-blue-700 rounded-md border-blue-900 border-2" name="goback_btn" type="submit">Go Back</button>
                        <hr class="w-full">
                        <div class="">
                            <button class="font-semibold bg-green-400 p-2 border-2 border-green-700 hover:bg-green-600 rounded-md" name="create_account" onclick="create_account()" type="submit">Create Account</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="footer-continer grid place-content-center min-w-10 text-center">
        <p class="min-w-10">
            <span class="font-semibold" id="currentYear"></span> Information Assurance Security
        </p>
    </div>
    <script>
        document.getElementById('currentYear').innerHTML = new Date().getFullYear();

    </script>
</body>
</html>
<?php
    if(isset($_POST["goback_btn"])) {
        header("Location:login_account.php");
    }

    if(isset($_POST["create_account"]) && !empty($_POST["username"]) && !empty($_POST["password"])) {

        $username = $_POST["username"];
        $password = $_POST["password"];

        $hashed_pass = password_hash($password,PASSWORD_DEFAULT);

        $insert_data = "INSERT into accounts (Username, Pass)
                    VALUES ('$username', '$hashed_pass')";
        if($sqlConn->query($insert_data)== TRUE) {
            echo "account added";
        } else {
            echo "An error occured";
        }
        mysqli_close($sqlConn);
    }
?>