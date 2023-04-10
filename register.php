<?php
require_once "auth.php";
 
// Define variables
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Wprowadź nazwę użytkownika.";
    }elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Nazwa użytkownika może zawierać jedynie litery, cyfry i podkreślenia.";
    }else{
        
        $sql = "SELECT User_ID FROM Users WHERE User_Name = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables 
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute
            if(mysqli_stmt_execute($stmt)){
                //store result
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Użytkownik o takiej nazwie już istnieje.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Coś nie wyszło!";
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Wprowadź hasło.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Hasło musi mieć przynajmniej 6 znaków.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Potwierdź hasło.";     
    }else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Hasło się nie zgadza!";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        // insert data in database, first username so ID generates.
        $sql = "INSERT INTO Users(User_Name) VALUES(?)";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            //Bind variables
            mysqli_stmt_bind_param($stmt, "s",$param_username);
            //Set parameter
            $param_username = trim($_POST["username"]);
            //Attempt to execute
            if(!mysqli_stmt_execute($stmt)){
                echo("Error during username insertion");
            }
        }
        
        $sql = "INSERT INTO Passwords(User_ID, Pass) VALUES (?, ?)";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables
            mysqli_stmt_bind_param($stmt, "ds",$last_id,$param_password);
            // Set parameters
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $last_id = mysqli_insert_id($connection);
            // Attempt to execute 
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Coś nie wyszło!";
            }
            mysqli_stmt_close($stmt);
        }
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
    <div class="wrapper">
        <h1 class="header">REJESTRACJA</h1>
        <form class="login-form" accept-charset="UTF-8" action="<?php echo($_SERVER["PHP_SELF"]); ?>" autocomplete="off" method="POST">
	    
        <label for="username">Nick</label>
	    <input type="text" name="username" value="<?php echo $username; ?>">
        <span class="invalid"><?php echo $username_err; ?></span>
        
        <label for="password">Hasło</label>
        <input type="password" name="password" value="<?php echo $password; ?>">
        <span class="invalid"><?php echo $password_err; ?></span>
	    
        <label>Potwierdź hasło</label>
        <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
        <span class="invalid"><?php echo $confirm_password_err; ?></span>

        <button class="button form" type="submit" value="Submit">WYŚLIJ</button>
        </form>
    </div>
</body>
</html>