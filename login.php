<?php
session_start();
 
// Check if the user is already logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

require_once "auth.php";

// Define 
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT Users.User_ID, Users.User_Name, Passwords.Pass FROM Users JOIN Passwords ON Users.User_ID=Passwords.User_ID WHERE User_Name = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct -> start new session
                            session_start();
                            
                            // Store in session 
                            $_SESSION["loggedin"] = true;
                            $_SESSION["user_id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Password is not valid
                            $login_err = "Nieprawidłowy login lub hasło.";
                        }
                    }
                } else{
                    // Username doesn't exist
                    $login_err = "Nieprawidłowy login lub hasło.";
                }
            } else {
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
        <h1 class="header">LOGIN</h1>
        <?php 
            if(!empty($login_err)){
                echo '<div class="invalid">' . $login_err . '</div>';
            }        
        ?>
        <form class="login-form" accept-charset="UTF-8" action="<?php echo($_SERVER["PHP_SELF"]) ?>" autocomplete="on" method="POST">
	    
        <label for="username">Nick</label>
	    <input name="username" type="text" placeholder="nick">
        <span class="invalid"><?php echo $username_err; ?></span>

        <label for="password">Hasło</label>
	    <input name="password" type="password" placeholder="Hasło">
        <span class="invalid"><?php echo $password_err; ?></span>

        <button class="button form" type="submit" value="Submit">WYŚLIJ</button>
        </form>
        <p>Nie masz konta? <a href="register.php">Zarejestruj się!</a>.</p>
    </div>
</body>
</html>