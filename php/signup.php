<?php
echo "started";
    if(isset($_POST['signup']))
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "schooldb";
        $conn = new mysqli($servername, $username, $password);
        if($conn->connect_error)
        {
            die("Connection failed: ". $conn->connect_error);
        }
        $sql = 'CREATE DATABASE IF NOT EXISTS schooldb' ;
        $retvel = $conn->query($sql) ;
        $conn -> select_db("schooldb");

        $sql = "USE schooldb";
        $retvel = $conn->query($sql) ;

        $sql = "CREATE TABLE IF NOT EXISTS user (
            usr_id VARCHAR(255) NOT NULL,
            usr_email VARCHAR(255) NOT NULL,
            usr_password VARCHAR(255) NOT NULL,
            PRIMARY KEY (usr_id, usr_password)
        )";

        if($conn->query($sql) === FALSE)
        {
            die("Error creating table: " . $conn->error);
        }

        $usr_id = $_POST['usr_id'];
        $usr_email = $_POST['usr_email'];
        $usr_password = $_POST['usr_password'];

        $sql = "INSERT INTO user (usr_id, usr_email, usr_password) VALUES ('$usr_id', '$usr_email', '$usr_password')";
        if($conn->query($sql) === FALSE)
        {
            die ('Could not enter data:'. $conn->error);
        }
        echo "user created";
        header("Location: ../main.html");
        exit();
        $conn->close();
    }
?>