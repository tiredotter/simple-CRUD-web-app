<?php
    // Initialize the session
    session_start(); 
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }

    require_once("auth.php");
    require_once("functions.php");
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
        <div class="item-box">
            <div class="header">
                <h1>MOJE ZESTAWY</h1>
            </div>

            <div class="">
                <a href="./create.php"><img src="icons/add.svg" alt="create set" style="width:20px; height: 20px;"></a>
            </div>
            

            <div class="content-table">
                <?php
                    getUserSets($connection, $_SESSION["user_id"]);
                ?>
            </div>

            <div>
                <img src="">
                <form class="note-input" accept-charset="UTF-8" action="./search.php" method="POST">
	                <input id="search" name="search" type="text" placeholder="Enter searched value..."/>
                    <a href="search.php"><button class="button form" type="submit" value="Submit">Szukaj</button></a>
                </form>
            </div>
    </main>
</body>
</html>

