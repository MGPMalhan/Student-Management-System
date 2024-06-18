<?php 


       // $connection = mysqli_connect(dbserver,dbuser,dbpass,dbname);

       $connection = mysqli_connect('localhost','root','','Crud_Operations');
        
        // mysqli_connect_errorno();  mysqli_connect_error();

        // checking the connection 

        if (mysqli_connect_errno()) {
            die('Database connnection failed' .mysqli_connect_error());
        } else {
            //echo "Database connection successful";
        }

