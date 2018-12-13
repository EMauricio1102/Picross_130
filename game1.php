<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "dbgarzamaurico";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO games (player_id, duration, errors, levelsize, score)
VALUES ('1', '21', '22', '7x7', '19')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>