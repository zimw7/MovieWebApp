<!--
  File Name: new.php
  Create Date: November 19, 2023
  Purpose: This file handles the creation of new movie entries in the database. It processes the movie data submitted via the form, including handling the movie poster upload or URL, and inserts this data into the database.  
-->

<?php

// Start the session to maintain session state
session_start();

// Include database connection and header
require_once('db_connection.php');
require_once('header.php');

// Check if the request method is POST, which indicates form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize input data to prevent SQL injection
    $movie_title = mysqli_real_escape_string($conn, $_POST['movie_title']);
    $director = mysqli_real_escape_string($conn, $_POST['director']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $genre_id = mysqli_real_escape_string($conn, $_POST['genre_id']);
    
    // Define default poster and poster URL
    $default_poster_url = 'http://localhost/Assignment 2/image/default_poster.png';
    $poster_url = '';

    // Handle file upload
    if (!empty($_FILES['movie_poster_file']['name'])) {

        // Define target directory and file name
        $target_dir = "uploads/";
        $file_name = basename($_FILES["movie_poster_file"]["name"]);
        $target_file = $target_dir . $file_name;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["movie_poster_file"]["tmp_name"], $target_file)) {
            $poster_url = 'http://localhost/Assignment 2/server/uploads/' . $file_name;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        
    // Handle poster URL
    } elseif (!empty($_POST['movie_poster_url'])) {
        // Use URL provided by user if file upload is not done
        $poster_url = $_POST['movie_poster_url'];
    } else {
        // Use default poster if neither file nor URL is provided
        $poster_url = $default_poster_url;
    }

    // Capture movie rating
    $movie_rating = mysqli_real_escape_string($conn, $_POST['movie_rating']);

    // Insert movie data into database
    $query = "INSERT INTO movies (movie_title, director, year, genre_id, poster_url, movie_rating) VALUES ('$movie_title', '$director', '$year', '$genre_id', '$poster_url', '$movie_rating')";

    // Execute query
    $result = mysqli_query($conn, $query);

    // Redirect to dashboard on successful insertion, otherwise display error
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
    <title>New Movie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/Assignment 2/css/style.css">
</head>
<body>

    <!-- New Movie Form -->
    <main class="main">

        <!-- Display form to add new movie -->
        <h2 class="form-title">New Movie</h2>
        <form class="form" method="post" enctype="multipart/form-data">
            <input type="text" class="form-control" name="movie_title" placeholder="Movie Title" required>
            <input type="text" class="form-control" name="director" placeholder="Director" required>
            <input type="number" class="form-control" name="year" placeholder="Year" required>

            <!-- Display dropdown of genres -->
            <select class="form-select" name="genre_id">

                <!-- Display default option -->
                <option value="">Select a Genre</option>

                <!-- Loop through genres and display each as an option -->
                <?php foreach($genres as $genre) :?>
                    <option value="<?php echo $genre['genre_id']; ?>"><?php echo $genre['genre_title']; ?></option>
                <?php endforeach; ?>

            </select>

            <!-- Display file upload and URL input fields -->
            <input type="file" class="form-control" name="movie_poster_file" accept="image/*">
            <input type="text" class="form-control" name="movie_poster_url" placeholder="Or input an image URL">
            <!-- Display movie rating input field -->
            <input type="text" class="form-control" name="movie_rating" placeholder="Enter Movie Rating">
            <!-- Display submit button -->
            <button type="submit" class="button">Add Movie</button>
            
        </form>
    </main>

    <?php require_once('footer.php'); ?>
    
</body>
</html>
