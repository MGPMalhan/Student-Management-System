<?php include('includes/header.php'); ?>
<?php include('includes/Connection.php'); ?>

<?php
// Check if 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute SELECT query to fetch student record
    $query = "SELECT * FROM `students` WHERE `ID` = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // If no records found, display error message and terminate
    if ($result->num_rows === 0) {
        die("Record not found.");
    } else {
        // Fetch the student record
        $row = $result->fetch_assoc();
    }
} else {
    // If 'id' parameter is not provided in the URL, display error message and terminate
    die("ID not provided.");
}

// Check if the 'Update' button is clicked
if (isset($_POST['Update'])) {
    // Retrieve form data
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $age = $_POST['age'];

    // Prepare and execute UPDATE query to update student record
    $update_query = "UPDATE `students` SET `first_name` = ?, `last_name` = ?, `age` = ? WHERE `ID` = ?";
    $update_stmt = $connection->prepare($update_query);
    $update_stmt->bind_param("ssii", $fname, $lname, $age, $id);
    $update_result = $update_stmt->execute();

    // If update fails, display error message and terminate
    if (!$update_result) {
        die("Update failed: " . $update_stmt->error);
    } else {
        // If update successful, redirect to index.php with success message
        header('Location: index.php?upt_msg=Update_Successful');
        exit();
    }
}
?>

<form id="updateForm" action="update.php?id=<?php echo $id; ?>" method="post">
    <div class="modal-body">
        <div class="form-group_1">
            <label for="f_name">First Name</label>
            <input type="text" name="f_name" class="form-control" value="<?php echo isset($row['first_name']) ? htmlspecialchars($row['first_name']) : ''; ?>">
        </div>
        <div class="form-group_1">
            <label for="l_name">Last Name</label>
            <input type="text" name="l_name" class="form-control" value="<?php echo isset($row['last_name']) ? htmlspecialchars($row['last_name']) : ''; ?>">
        </div>
        <div class="form-group_1">
            <label for="age">Age</label>
            <input type="text" name="age" class="form-control" value="<?php echo isset($row['age']) ? htmlspecialchars($row['age']) : ''; ?>">
        </div>
    </div>

    <input type="submit" class="btn btn-success" name="Update" value="Update Student" style="margin-left: 35px;">
</form>

<?php include('includes/footer.php'); ?>
