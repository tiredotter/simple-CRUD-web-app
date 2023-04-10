<?php
    session_start();
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    
?>
<?php
    require_once "auth.php";
        // Check if delete was confirmed
    if (isset($_GET["usun"])) {
        if ($_GET["usun"] == 'true') {
            $sql = "DELETE FROM `Sets` WHERE Set_ID = ? AND Author_ID = ?";
            if ($stmt = mysqli_prepare($connection, $sql)) {
                mysqli_stmt_bind_param($stmt, "dd", $param_ID, $param_Author_ID);
                // Set parameters
                $param_ID = $_GET["curr_ID"];
                $param_Author_ID = $_SESSION["user_id"];

                // Attempt to execute
                if (!mysqli_stmt_execute($stmt)) {
                    echo ("Coś poszło nie tak podczas usuwania notatki!");
                }
                // Redirect user to dashbord page
                header("location: index.php");
                mysqli_stmt_close($stmt);
            }
        } elseif ($_GET["usun"] == 'false') {
            header("location: index.php");
        }
        mysqli_close($connection);
    }
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Nunito+Sans&display=swap" rel="stylesheet">
    <title>EPISCUS</title>
</head>
<body>
    <main class="wrapper">
        <h1 class = "header">Czy na pewno chcesz usunąć notatkę?</h1>
            <div class="subsite">
                <a href="<?php echo("delete.php?curr_ID=". $_GET['curr_ID'] ."&usun=true")?>"><button class="button">TAK</button></a>
                <a href="<?php echo("delete.php?curr_ID=". $_GET['curr_ID'] ."&usun=false")?>"><button class="button">NIE</button></a>
            </div>
    </main>
</body>
</html>