<?php 
include('includes/Connection.php'); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Using prepared statements to prevent SQL injection
    $query = "DELETE FROM `students` WHERE `ID` = ?";
    $stmt = mysqli_prepare($connection, $query);
    
    // Binding the parameter to the prepared statement
    mysqli_stmt_bind_param($stmt, 'i', $id);
    
    // Executing the statement
    $result = mysqli_stmt_execute($stmt);

    // Closing the statement
    mysqli_stmt_close($stmt);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        header('Location: index.php?delete_msg=The student has been deleted successfully');
        exit();
    }
} else {
    die("ID not set.");
}

