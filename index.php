    <?php include('includes/header.php'); ?>
    <?php include('includes/Connection.php'); ?>

<table class="table table-hover table-bordered table-striped">

    <div class="box_1">
    
    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">New Student Entry</button>
    </div>

    <thead>
        <tr>
            <th>ID</th>
            <th>First_Name</th>
            <th>Last_Name</th>
            <th>Age</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        // pulling data out from the database
        $query = "SELECT * FROM `students` ";

        // $result hold the entire set of data that the query will return
        $result = mysqli_query($connection, $query);
        
        // Checking if the connection is made and query is successful or not / whether the dollar variable holds somthing or not.
        
        // if(!$result) : This means if the query is failed in a way
        if(!$result) {
            die("Query failed: " . mysqli_error($connection));
        } else {
            // Looping through the rows of the database so that we can show each row from the database 
            while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['ID']; // Pulling the exact data from database dynamically in our application ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><a href="update.php?id=<?php echo $row['ID']; ?>" class="btn btn-success">Update</a></td>
                    <td><a href="delete_data.php?id=<?php echo $row['ID']; ?>" class="btn btn-danger" class="btn btn-cell">Delete</a></td>
                </tr>
        <?php 
            }
        }
        ?>

    </tbody>
    </table>

    
            <?php
            // the message you get after the operation is successful
                if (isset($_GET['message'])) {
                    echo '<h6 class="message">' . $_GET['message'] . '</h6>';
                }
            ?>

            <?php
                if (isset($_GET['insert_msg'])) {
                    echo '<h6 class="insert_msg">' . $_GET['insert_msg'] . '</h6>';
                }
            ?>

            <?php
                if (isset($_GET['delete_msg'])) {
                    echo '<h6 class="delete_msg">' . $_GET['delete_msg'] . '</h6>';
                }
            ?>



    <!-- Modal -->
    <form method="post" action="insert_data.php">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Student Entry</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">

                <label for="f_name">First Name</label>
                <input type="text" name="f_name" class="form-control">

                <label for="l_name">Last Name</label>
                <input type="text" name="l_name" class="form-control">

                <label for="Age">Age</label>
                <input type="text" name="Age" class="form-control">

            </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" name="add_students" value="ADD"></input>
      </div>
    </div>
  </div>
</div>
</form>

    <?php include('includes/footer.php'); ?>
