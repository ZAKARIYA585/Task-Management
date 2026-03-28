<?php
    session_start();
    include "database.php";
    $error = "";

    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $title = $_POST["title"];
        $desc = $_POST["desc"];
        $priority = $_POST['priority'];
        $status = $_POST['status']?? '';
        $date = $_POST['date'];

        if (empty($title) || empty($desc) || empty($priority) || empty($status) || empty($date)) {
            $error = "All fields are required";
            // header("Location:add.php");
        }
        else{
            $sql = "insert into add_tasks(user_id, title, description, priority, status, due_date) VALUES('$user_id', '$title', '$desc', '$priority', '$status', '$date')";
            $_result = mysqli_query($conn, $sql);

            if($_result){
                echo "data insert successfully";
                header("Location: display.php");
            }

            else{
                echo "data send problem" . mysqli_error($conn);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <link rel="stylesheet" href="form_style.css">
</head>
<body>

    <form class="task-form" method="post">
        <h2>Add Task</h2>

        <div class="form-group">
            <label>Task Title</label>
            <input type="text" name="title" placeholder="Enter Task Title">
        </div>

        <div class="form-group">
            <label>Description</label>
            <input type="text" name="desc" placeholder="Enter Task Description">
        </div>

        <div class="form-group">
            <label>Priority</label>
            <select name="priority">
                <option value="Low" >Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>

        <div class="form-group">
            <label>Status</label>
            <div class="radio-group">
                <label><input type="radio" name="status" value="Pending"> Pending</label>
                <label><input type="radio" name="status" value="In Progress"> In Progress</label>
                <label><input type="radio" name="status" value="Completed"> Completed</label>
            </div>
        </div>

        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date">
        </div>

        <button type="submit" name="submit">Add Task</button>
    </form>

    <?php if (!empty($error)) { ?>
        <p style="color:red; text-align:center;">
            <?php echo $error; ?>
        </p>
    <?php } ?>


</body>
</html>
