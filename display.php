<?php
    session_start();
    include "database.php";
    $error = "";
    
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];

    $sql = "select * from add_tasks Where user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    // $user = mysqli_fetch_assoc($result);    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Tasks</title>
    <link rel="stylesheet" href="table_style.css">
</head>
<body>

<div class="container">

    <div class="header">        
        <h2>Task List</h2>
        <a href="add.php" class="add-btn">+ Add Task</a>
        <a href="logout.php" class="logout-btn" onclick="return confirm('Are you sure you want to logout?')" >
           Logout
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Task Title</th>
                <th>Description</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Date</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody>
        <?php if (isset($result) && mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td>
                        <span class="badge <?= $row['priority']; ?>">
                            <?= $row['priority']; ?>
                        </span>
                    </td>
                    <td>
                        <span class="badge <?= $row['status']; ?>">
                            <?= $row['status']; ?>
                        </span>
                    </td>
                    <td><?= $row['due_date']; ?></td>
                    <td class="action">
                        <a href="edit.php?id=<?= $row['id']; ?>" class="edit">Edit</a>
                        <a href="delete.php?id=<?= $row['id']; ?>" class="delete"
                           onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="6" class="no-data">No tasks found</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

</body>
</html>