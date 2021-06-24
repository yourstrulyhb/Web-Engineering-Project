<?php

$servername = "localhost";
$username = "root";  // default username
$password = ""; // default password
$dbname = "blogs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

// CREATE TABLES

// users
$sql = "CREATE TABLE users (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
admin TINYINT(4) NOT NULL,
username VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
   echo "Table users created successfully";
} else {
   echo "Error creating table: " . $conn->error;
}

// topics
$sql = "CREATE TABLE topics (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
description TEXT
)";

if ($conn->query($sql) === TRUE) {
   echo "Table topics created successfully";
} else {
   echo "Error creating table: " . $conn->error;
}

// feedbacks
$sql = "CREATE TABLE feedbacks (
fbID INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(255) NOT NULL,
name VARCHAR(255),
message TEXT NOT NULL,
sendDate DATE DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
   echo "Table feedbacks created successfully";
} else {
   echo "Error creating table: " . $conn->error;
}


// posts
$sql = "CREATE TABLE posts (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id INT(11) NOT NULL,
topic_id INT(11),
title VARCHAR(255) NOT NULL,
image VARCHAR(255) NOT NULL,
body TEXT NOT NULL,
published TINYINT(4),
publishedDate DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (user_id) REFERENCES users(id),
FOREIGN KEY (topic_id) REFERENCES topics(id)
)";

if ($conn->query($sql) === TRUE) {
   echo "Table posts created successfully";
} else {
   echo "Error creating table: " . $conn->error;
}


$conn->close();











?>