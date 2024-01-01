<!--
  File Name: show.php
  Create Date: November 19, 2023
  Purpose: This file displays the details of a selected movie. It retrieves movie information from the database and presents it, along with options to delete the movie.
-->

<?php

session_start(); // Start session to store user data
require_once('db_connection.php'); // Include database connection
require_once('header.php'); // Include header file

// Fetch genres for displaying the genre title
$genres_query = "SELECT * FROM genres";

// Execute query and store results
$genres_result = mysqli_query($conn, $genres_query);

// Initialize genres array
$genres = [];

// Store genre titles in an array
while ($genre = mysqli_fetch_assoc($genres_result)) {
    $genres[$genre['genre_id']] = $genre['genre_title'];
}

// Fetch and display movie details
if (isset($_GET['id'])) {

    // Fetch movie details
    $movie_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query to fetch movie details
    $movie_query = "SELECT * FROM movies WHERE movie_id = '$movie_id'";

    // Execute query and store results
    $movie_result = mysqli_query($conn, $movie_query);

    // Check if movie exists
    if ($movie_result && mysqli_num_rows($movie_result) > 0) {

        // Fetch movie details
        $movie = mysqli_fetch_assoc($movie_result);

        // Set default poster if no poster is uploaded
        $poster_url = $movie['poster_url'] ?? 'default_poster.jpg';

        // Set genre title to Unknown Genre if genre is not found
        $genre_title = $genres[$movie['genre_id']] ?? "Unknown Genre";

    } else {
        // Redirect to dashboard if movie not found
        echo "Movie not found";
        exit;
    }
}

// Handle movie deletion
if (isset($_GET['delete_id'])) {

    // Sanitize movie id
    $movie_id = mysqli_real_escape_string($conn, $_GET['delete_id']);

    // Query to delete movie
    $query = "DELETE FROM movies WHERE movie_id = '$movie_id'";

    // Execute query
    $result = mysqli_query($conn, $query);

    // Check if deletion was successful
    if ($result) {
        // Redirect to dashboard
        header("Location: dashboard.php"); 
        exit;
    } else {
        // Display error message
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!-- HTML content here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/Assignment 2/css/style.css">
</head>
<body>

    <!-- Movie Details -->
    <div class="movie-info">

        <!-- Display movie poster, title, year, genre, director, and rating -->
        <img src="<?php echo htmlspecialchars($poster_url); ?>" alt="Poster for <?php echo htmlspecialchars($movie['movie_title']); ?>" class="movie-poster">
        <h2><?php echo $movie['movie_title']; ?></h2>
        <p>Year: <?php echo $movie['year']; ?></p>
        <p>Genre: <?php echo $genre_title; ?></p>
        <p>Director: <?php echo $movie['director']; ?></p>
        <p>Rating: <?php echo htmlspecialchars($movie['movie_rating']); ?></p>

    </div>

    <!-- Display button to delete movie -->
    <div class="button-container">

        <!-- Form to delete movie -->
        <form name="movie_id" action="show.php" method="get" onsubmit="return confirmDelete()">

            <!-- Hidden input to store movie id -->
            <input type="hidden" name="delete_id" value="<?php echo $movie['movie_id']; ?>">

            <!-- Delete button -->
            <button type="submit" class="delete-button">Delete</button>

        </form>

    </div>

    
    <!-- Script to confirm movie deletion -->
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this movie?");
        }
    </script>

</body>
</html>
