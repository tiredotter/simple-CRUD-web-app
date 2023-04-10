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
    // Define 
    $note = $title = "";
    $note_err = $title_err = ""; 
    
    //prepare note content from database
    if(isset($_GET['curr_ID'])){
        $sql = 'SELECT `Set_Name`,`Set_Content` FROM `Sets` WHERE  Set_ID = '. $_GET["curr_ID"] .' AND Author_ID = '. $_SESSION["user_id"] .';';
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_row($result);
    }

    // Processing form data 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Check if no errors occured and execute statement
        $sql = "UPDATE `Sets` SET Set_Name=? , Set_Content = ? WHERE Set_ID = ? AND Author_ID = ?" ;
        if($stmt = mysqli_prepare($connection, $sql)){
            mysqli_stmt_bind_param($stmt, "ssdd", $param_title, $param_note, $id, $param_user_ID);
            // Set parameters
            $param_title = trim($_POST["title"]);
            $param_note = trim($_POST["note"]);
            $id = $_POST["curr_ID"];
            $param_user_ID = $_SESSION['user_id'];
            // Attempt to execute
            if(!mysqli_stmt_execute($stmt)){
                echo("Coś poszło nie tak podczas tworzenia notatki!");
            }
            // Redirect user to dashbord page
            header("location: index.php");
            mysqli_stmt_close($stmt);
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
    <link rel="stylesheet" href="./main.css?">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Nunito+Sans&display=swap" rel="stylesheet">
    <title>EPISCUS</title>
</head>
<body>
    <main class="wrapper">
        <div class="item-box">
            <div class="header">
            <form class="note-input" accept-charset="UTF-8" action="<?php echo($_SERVER["PHP_SELF"]) ?>" autocomplete="on" method="POST">
	            <label for="title">Tytuł</label>
	            <input name="title" type="text" placeholder="Wprowadź tytuł notatki tutaj" value="<?php echo($row[0]); ?>">
                <label for="note">Notatka:</label>
	            <textarea id="note" name="note" style="resize: none;"><?php echo ($row[1]);?></textarea>
                <input id="curr_ID" name="curr_ID" type="hidden" value="<?php echo($_GET["curr_ID"])?>">
                <button class="button form" type="submit" value="Submit">WYŚLIJ</button>
            </form>
            </div>
    </main>
</body>
</html>