<?php

$servername = "localhost";
$username = "root";  // default username
$password = ""; // default password

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

// Create blogs database
$createDB = "CREATE DATABASE blogs";
if ($conn->query($createDB) === TRUE) {
   echo "Database created successfully";

} else {
   echo "Error creating database: " . $conn->error;
}

$conn->close();

?>