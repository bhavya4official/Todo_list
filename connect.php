 <?php

// Create connection
$conn = new mysqli("localhost", "bhavya", "1234", "task_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> 
