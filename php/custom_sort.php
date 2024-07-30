<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "schooldb";

// Create connection
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "GET"){

$sql = "USE schooldb";
$retvel = $conn->query($sql) ;
if (!$retvel)
{
    die("Connection failed: " . $conn->connect_error);
}

echo "<body style=\"min-height: 100vh; background-color: lightblue;\">\n";
$start_date = $conn->real_escape_string($_GET['sdate']);;
$end_date = $conn->real_escape_string($_GET['ldate']);;

// Retrieve data from the 'book' table
$sql = "SELECT * FROM book WHERE date0 BETWEEN '$start_date' AND '$end_date' ORDER BY date0 ASC;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data in an HTML table
    echo "<table border = 1 style='background-color: white; width : 100%;'>";
    echo "<tr><th>Date</th><th>Work Day</th><th>Students<br>(1-5)</th><th>Students<br>(6-8)</th><th>Students<br>(9-10)</th><th>milk<br>(1-5)</th><th>rice<br>(1-5)</th><th>wheat<br>(1-5)</th><th>Dhal<br>(1-5)</th><th>Oil<br>(1-5)</th><th>salt<br>(1-5)</th><th>milk<br>(6-8)</th><th>rice<br>(6-8)</th><th>wheat<br>(6-8)</th><th>Dhal<br>(6-8)</th><th>Oil<br>(6-8)</th><th>salt<br>(6-8)</th><th>milk<br>(9-10)</th><th>rice<br>(9-10)</th><th>wheat<br>(9-10)</th><th>Dhal<br>(9-10)</th><th>Oil<br>(9-10)</th><th>salt<br>(9-10)</th></tr>"; // Add other column headers
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>". $row["date0"] . "</td>";
        echo "<td>". $row["work_day"] . "</td>";
        echo "<td>". $row["primary_students"] . "</td>";
        echo "<td>". $row["secondary_students"]. "</td>";
        echo "<td>". $row["tertiary_students"]. "</td>";
        echo "<td>". $row["primary_milk"]. "</td>";
        echo "<td>". $row["primary_rice"]. "</td>";
        echo "<td>". $row["primary_wheat"]. "</td>";
        echo "<td>". $row["primary_dhal"]. "</td>";
        echo "<td>". $row["primary_oil"]. "</td>";
        echo "<td>". $row["primary_salt"]. "</td>";
        echo "<td>". $row["secondary_milk"]. "</td>";
        echo "<td>". $row["secondary_rice"]. "</td>";
        echo "<td>". $row["secondary_wheat"]. "</td>";
        echo "<td>". $row["secondary_dhal"]. "</td>";
        echo "<td>". $row["secondary_oil"]. "</td>";
        echo "<td>". $row["secondary_salt"]. "</td>";
        echo "<td>". $row["tertiary_milk"]. "</td>";
        echo "<td>". $row["tertiary_rice"]. "</td>";
        echo "<td>". $row["tertiary_wheat"]. "</td>";
        echo "<td>". $row["tertiary_dhal"]. "</td>";
        echo "<td>". $row["tertiary_oil"]. "</td>";
        echo "<td>". $row["tertiary_salt"]. "</td>";
        // Add other columns here
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found.";
}

$conn->close();
}
?>
