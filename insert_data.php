<?php include('includes/Connection.php'); ?>
<?php
// First check if the user is pressing the submit button
if (isset($_POST['add_students'])){
    // Get the data from the form
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $age = $_POST['Age'];

    // Now perform form validation

    // Check if $f_name holds any data or not and if it's empty
    if ($f_name == '' || empty($f_name)) {
        // Redirect with a message
        header('location:index.php?message=You need to fill the First Name!');
    } elseif ($l_name == '' || empty($l_name)) {
        // Redirect with a message
        header('location:index.php?message=You need to fill the Last Name!');
    } elseif ($age == '' || empty($age)) {
        // Redirect with a message
        header('location:index.php?message=You need to fill the Age!');
    } else {
        // Prepare and execute the SQL query to insert data into `students` table
        $query = "INSERT INTO students (first_name, last_name, age) VALUES ('$f_name', '$l_name', '$age')";
        
        $result = mysqli_query($connection, $query);
        if(!$result){
            die("Query failed" . mysqli_error($connection));
        } else {
            header('location:index.php?insert_msg=Your insert operation was successful!');
        }
    }
}
?>
