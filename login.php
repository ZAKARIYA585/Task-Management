<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        header("Location: display.php");
        exit;
    }
    
    include "database.php";
    $error = "";

    if($_SERVER['REQUEST_METHOD'] === "POST"){        
        $email = trim($_POST['email']);
        $pswd = trim($_POST['pswd']);
        
        $sql = "select * from users Where email = '$email'";
        $result = mysqli_query($conn, $sql);            

        if($result && mysqli_num_rows($result) === 1){
            $user = mysqli_fetch_assoc($result);

            if(password_verify($pswd, $user['password'])){
                // print_r();die();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                
                header("Location: display.php");
                exit;
            }
            else{
                $error = "Invalid email and password";
            }
        }
        else{
            // echo "hello";die();
            $error  = "Invalid email and password";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="form_style.css">
</head>
<body>

    <form action="login.php" method="post" class="task-form">
        <h2>Login</h2>

        <div class="form-group">
            <input type="text" name="email" placeholder="Enter your Email" required>
        </div>
        <div class="form-group">
            <input type="password" name="pswd" placeholder="Enter your Password" required>
        </div>
        <div class="form-group">
            <button type="submit" name="submit" value="Login">Login</button>
        </div>

        <?php
            if (isset($error) && $error != "") {
                echo "<p class='error'>$error</p>";
            }
        ?>

        <div class="link">
            Not registered? <a href="register.php">Register</a>
        </div>
    </form>

</body>
</html>
