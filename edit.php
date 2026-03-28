<?php
    session_start();
    include "database.php";
    $error="";

    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit;
    }
    
    if(!isset($_GET['id'])){
        header("Location: display.php");
        exit;
    }
    
    $task_id = $_GET['id'];
    
    $sql = "select * from add_tasks where id = $task_id";
    $result = mysqli_query($conn, $sql);

    $task = mysqli_fetch_assoc($result);
    if(!$task){
        header("Location: display.php");
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $date = $_POST['date'];

        if(empty($title)||empty($desc)||empty($priority)||empty($status)||empty($date)){
            $error = "All field are required ";
        }else{
            $update_sql = "update add_tasks SET title='$title', description='$desc', priority='$priority', status='$status',due_date='$date' where id ='$task_id'";
            $update_result = mysqli_query($conn, $update_sql);

            if($update_result){
                header("Location: display.php");
            }
            else{
                echo "Update Failed :". mysqli_error($conn);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tasks</title>
    <link rel="stylesheet" href="form_style.css">
</head>
<body>

    <form action="#" method="post" class="task-form">
        <h2>Edit Task</h2>

        <div class="form-group">
            <label>Task Title</label>
            <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>">
        </div>
        <div class="form-group">
            <label>Description</label>
            <input type="text" name="desc" value="<?= htmlspecialchars($task['description']) ?>">
        </div>
        <div class="form-group">
            <label>Priority</label>
            <select name="priority">
                <option value="Low" <?= ($task['priority'] == 'Low') ? 'selected' : '' ?>>Low</option>
                <option value="Medium" <?= ($task['priority'] == 'Medium') ? 'selected' : '' ?>>Medium</option>
                <option value="High" <?= ($task['priority'] == 'High') ? 'selected' : '' ?>>High</option>
            </select>
        </div>
        <div class="form-group">
            <label>Status</label>
            <div class="radio-group">
                <label>
                    <input type="radio" name="status" value="Pending"
                    <?= ($task['status'] == 'Pending') ? 'checked' : '' ?>> Pending
                </label>

                <label>
                    <input type="radio" name="status" value="In Progress"
                    <?= ($task['status'] == 'In Progress') ? 'checked' : '' ?>> In Progress
                </label>

                <label>
                    <input type="radio" name="status" value="Completed"
                    <?= ($task['status'] == 'Completed') ? 'checked' : '' ?>> Completed
                </label>
            </div>
        </div>

        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date" value="<?= $task['due_date']; ?>">
        </div>

        <button type="submit" name="submit">Update Task</button>

        <?php if (!empty($error)) { ?>
            <p style="color:red; text-align:center;">
                <?php echo $error; ?>
            </p>
        <?php } ?>
    </form>

</body>
</html>
