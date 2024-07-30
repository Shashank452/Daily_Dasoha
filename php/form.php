<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "schooldb";

    // Create connection
    $conn = new mysqli($servername, $username, $password);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "USE schooldb";
    $retvel = $conn->query($sql) ;
    if (!$retvel)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = date('m') . ":" . date('y');

    $sql = "CREATE TABLE IF NOT EXISTS book (
        date0 DATE NOT NULL,
        work_day VARCHAR(255) NOT NULL,
        primary_students INT(100),
        secondary_students INT(100),
        tertiary_students INT(100),
        primary_milk INT(100),
        primary_rice INT(100),
        primary_wheat INT(100),
        primary_dhal INT(100),
        primary_oil DECIMAL(60),
        primary_salt INT(100),
        secondary_milk INT(100),
        secondary_rice INT(100),
        secondary_wheat INT(100),
        secondary_dhal INT(100),
        secondary_oil DECIMAL(60),
        secondary_salt INT(100),
        tertiary_milk INT(100),
        tertiary_rice INT(100),
        tertiary_wheat INT(100),
        tertiary_dhal INT(100),
        tertiary_oil DECIMAL(60),
        tertiary_salt INT(100)
    )";
    $retvel = $conn->query($sql) ;

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Escape user inputs for security
        $date = $conn->real_escape_string($_GET['date']);
        $holiday = $conn->real_escape_string($_GET['holiday']);


        if ($holiday == "no") {
            $primary_students = 0;
            $secondary_students = 0;
            $tertiary_students = 0;
            $grains = "";
        }elseif ($holiday == "yes") {
            $primary_students = $conn->real_escape_string($_GET['primary']);
            $secondary_students = $conn->real_escape_string($_GET['secondary']);
            $tertiary_students = $conn->real_escape_string($_GET['tertiary']);
            $grains = $conn->real_escape_string($_GET['grains']);
        }

        // Calculate other values (e.g., primary_milk, primary_rice, etc.)
        $primary_milk = $primary_students * 18;
        $primary_dhal = $primary_students * 20;
        $primary_oil = $primary_students * 5;
        $primary_salt = $primary_students * 2;

        $secondary_milk = $secondary_students * 18;
        $secondary_dhal = $secondary_students * 30;
        $secondary_oil = $secondary_students * 7.5;
        $secondary_salt = $secondary_students * 4;

        $tertiary_milk = $tertiary_students * 18;
        $tertiary_dhal = $tertiary_students * 30;
        $tertiary_oil = $tertiary_students * 7.5;
        $tertiary_salt = $tertiary_students * 4;

        if($grains == "rice")
        {
            $primary_rice = $primary_students * 100;
            $secondary_rice = $secondary_students * 150;
            $tertiary_rice = $tertiary_students * 150;
        }
        else if($grains == "wheat")
        {
            $primary_wheat = $primary_students * 100;
            $secondary_wheat = $secondary_students * 150;
            $tertiary_wheat = $tertiary_students * 150;
        }

        // Insert data into database
        $sql = "INSERT INTO book (date0, work_day, primary_students, secondary_students, tertiary_students, primary_milk, primary_rice, primary_wheat, primary_dhal, primary_oil, primary_salt, secondary_milk, secondary_rice, secondary_wheat, secondary_dhal, secondary_oil, secondary_salt, tertiary_milk, tertiary_rice, tertiary_wheat, tertiary_dhal, tertiary_oil, tertiary_salt)
        VALUES ('$date', '$holiday', '$primary_students', '$secondary_students', '$tertiary_students', '$primary_milk', '$primary_rice', '$primary_wheat', '$primary_dhal', '$primary_oil', '$primary_salt', '$secondary_milk', '$secondary_rice', '$secondary_wheat', '$secondary_dhal', '$secondary_oil', '$secondary_salt', '$tertiary_milk', '$tertiary_rice', '$tertiary_wheat', '$tertiary_dhal', '$tertiary_oil', '$tertiary_salt')";

        if ($conn->query($sql) === TRUE) {
            echo "Data inserted successfully";
            header("Location:../html/home.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close connection
    $conn->close();

?>
