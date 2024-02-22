<?php

$conn = mysqli_connect("localhost", "root", "", "");
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$database = "act1";
$query = "CREATE DATABASE IF NOT EXISTS $database";
if (mysqli_query($conn, $query)) {
    echo "Database created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

mysqli_select_db($conn, $database);

$table = "student";
$query = "CREATE TABLE IF NOT EXISTS $table (
    schoolid  INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    middle_initial VARCHAR(1),
    last_name VARCHAR(50) NOT NULL,
    gender ENUM('Male', 'Female') NOT NULL,
    date_of_birth DATE NOT NULL,
    course VARCHAR(50) NOT NULL,
    year_level VARCHAR(50) NOT NULL
)";
if (mysqli_query($conn, $query)) {
    echo "Table created successfully or already exists.<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
}
?>