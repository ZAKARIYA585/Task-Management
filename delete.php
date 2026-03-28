<?php
    include "database.php";
    
    if(isset($_GET['id'])){
        $task_id = $_GET['id'];

        $check_sql = "select * from add_tasks WHERE id=$task_id";
        $check_result = mysqli_query($conn, $check_sql);

        if(mysqli_num_rows ($check_result) > 0){

            $sql = "delete from add_tasks where id=$task_id";
            $result = mysqli_query($conn, $sql);

            if($result){
                header("Location: display.php");
                exit;
            }
            else{
                echo "Delete functionaliyti failed !" . mysqli_error($conn);
            }
        }else{
            echo "This task ID does not exist";
        }
    }
?>