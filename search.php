<?php
session_start();
// Check if the user is already logged in
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once("auth.php");

$set_err ="";
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
                <h1>WYNIKI WYSZUKIWANIA</h1>
            </div>
            <div>
                <?php
                    // Processing form data 
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        // Check if no errors occured and execute statement
                        $sql = "SELECT `Set_Name`,`Set_ID` FROM `Sets` WHERE Set_Name LIKE '%". $_POST["search"] ."%' AND Author_ID = ?";
                        if($stmt = mysqli_prepare($connection, $sql)){
                            mysqli_stmt_bind_param($stmt, "d", $param_user_ID);
                            // Set parameters
                            //$param_search = '%{$_POST["search"]}%';
                            $param_user_ID = $_SESSION['user_id'];
                            // Attempt to execute
                            if(!mysqli_stmt_execute($stmt)){
                                echo("Coś poszło nie tak podczas wyszukiwania!");
                            }
                            // store result
                            mysqli_stmt_store_result($stmt);
                                    
                            if(mysqli_stmt_num_rows($stmt) == 0){
                                $set_err = "Brak takich zestawów!";
                            }else{
                                mysqli_stmt_bind_result($stmt, $name, $ID);
                                echo '<table class="set-table"><tbody>';
                                while (mysqli_stmt_fetch($stmt)) {
                                    echo (
                                        '<tr>'
                                        . '<td>'
                                        . $name
                                        . '</td>'
                                        . '<td><a href="edit.php?curr_ID='. $ID .'"><img src="icons/edit.svg" style="width:20px; height: 20px;"></a></td>'
                                        . '<td><a href="delete.php?curr_ID='. $ID .'"><img src="icons/trash.svg" style="width:20px; height: 20px;"></a></td>'
                                        . '</tr>'
                                    );
                                }
                                echo '</tbody></table>';
                            }
                            mysqli_stmt_close($stmt);
                        }
                        mysqli_close($connection);
                    }
                ?>
                <span class=""><?php echo $set_err; ?></span>
            </div>
        </div>
    </main>
</body>
</html>