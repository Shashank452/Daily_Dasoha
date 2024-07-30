<?php
    if(isset($_POST['Login']))
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "schooldb";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if($conn->connect_error)
        {
            die("Connection failed: ". $conn->connect_error);
        }

        $usr_id = $_POST['usr_id'];
        $usr_password = $_POST['usr_password'];

        // Prepare and bind the query
        $stmt = $conn->prepare("SELECT * FROM user WHERE usr_id=? AND usr_password=?");
        $stmt->bind_param("ss", $usr_id, $usr_password);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0)
        {
            header("Location: ../html/home.html");
            exit();
        }
        else
        {
            echo "Invalid Username or password";
        }

        $stmt->close();
        $conn->close();
    }
?>
