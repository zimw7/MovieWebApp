<!--
  File Name: db_connection.php
  Create Date: November 19, 2023
  Purpose: This file establishes a connection to the MySQL database. It is included in other PHP scripts to access the 'db_movies' database for various operations.
-->

<?php

// Database connection parameters
$servername = "localhost";
$username = "root";    // Default username for MySQL
$password = "";       // Default password for MySQL
$dbname = "db_movies"; // Name of the database

// Create a new connection instance
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch all movies
$sql = "SELECT * FROM movies";
$result_set = mysqli_query($conn, $sql);
$movies = mysqli_fetch_all($result_set, MYSQLI_ASSOC);

// Query to fetch all genres
$sql = "SELECT * FROM genres";
$result_set = mysqli_query($conn, $sql);
$genres = mysqli_fetch_all($result_set, MYSQLI_ASSOC);

?>

