<?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        header("Location: display.php");
        exit;
    }
    
    include "database.php";
    $error = "";

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $rawPassword = trim($_POST['pswd']);
        
        //2 type condition check all field fill or not 
        // if($name == "" || $email == "" || $rawPassword == "")
        if(empty($name)|| empty($email)|| empty($rawPassword)){
            $error = 'All field are required' ;
        }
        else{
            $pswd = password_hash($rawPassword, PASSWORD_DEFAULT);
        
            $sql = "insert into users(name, email, password) VALUES('$name', '$email', '$pswd')";
            $result = mysqli_query($conn, $sql); 
            if($result){
                header("Location: login.php");
                exit;
            }

            else{
                $error = "error" . mysqli_error($conn);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="form_style.css">
</head>
<body>

    <form action="register.php" method="post" class="task-form">
        <h2>Register</h2>

        <div class="form-group">
            <input type="text" name="name" placeholder="Enter your Name" required>
        </div>
        <div class="form-group">
            <input type="text" name="email" placeholder="Enter your Email" required>
        </div>
        
        <div class="form-group">
            <input type="password" name="pswd" placeholder="Enter your Password" required>
        </div>

        <div class="form-group">
        <button type="submit" name="submit" value="Register" >Register </button>
</div>
        <?php
            if (isset($error) && $error != "") {
                echo "<p class='error'>$error</p>";
            }
        ?>

        <div class="link">
            Already registered? <a href="login.php">Login</a>
        </div>
    </form>

</body>
</html>
