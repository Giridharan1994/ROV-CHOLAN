<?php
$servername = "localhost";
$username = "root";
$password = "rovcholan";
$dbname = "rovcholan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$str="haribol";
//$str = mysql_real_escape_string($str);

$sql = "INSERT INTO newdata (sensedata) VALUES ('{$str}')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
