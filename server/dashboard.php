<!--
  File Name: dashboard.php
  Create Date: November 19, 2023
  Purpose: This file serves as the main dashboard of the Flick Archive, displaying a list of movies. It includes functionality for searching and filtering movies based on various criteria. 
-->

<?php

session_start();//start session

require_once('db_connection.php');//connect to database
require_once('header.php');//include header

// Define the base SQL query to fetch all movies
$sql = "SELECT * FROM movies";

// Initializes an empty array of where clauses
$whereClauses = [];

// Check if the "search" query string exists and is not empty
if (isset($_GET['search']) && $_GET['search'] != '') {

  // Escape special characters in the search query and takes the search query from the URL
  $search = mysqli_real_escape_string($conn, $_GET['search']);

  // Add where clauses to the query to search for the query in any of the movie attributes
  $whereClauses[] = "(movie_title LIKE '%$search%' OR director LIKE '%$search%' OR year LIKE '%$search%' OR genre_id LIKE '%$search%')";
}

// Check if the "filter" query string exists and is not empty
if (isset($_GET['filter']) && $_GET['filter'] != '') {

  // Escape special characters in the genre id and takes the genre id from the URL
  $genre_id = mysqli_real_escape_string($conn, $_GET['filter']);

  // Add where clauses to the query to filter by genre
  $whereClauses[] = "genre_id = '$genre_id'";

}

// Construct the query by imploding the where clauses with "AND"
if (!empty($whereClauses)) {
  // Combine all where clauses with "AND"
  $sql .= " WHERE " . implode(" AND ", $whereClauses);
}

// Execute the query and fetch results, check if "filter" is set, if not, set it to empty string
$selected_genre_id = isset($_GET['filter']) ? $_GET['filter'] : '';

// Fetch all genres
$result_set = mysqli_query($conn, $sql);

// Return an associative array of genres
$movies = mysqli_fetch_all($result_set, MYSQLI_ASSOC);

?>

<!-- Dashboard Page -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movies</title>

  <!-- Link to stylesheet -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://localhost/Assignment 2/css/style.css">

</head>

<body>
  <main class="main">

    <!-- Search and Filter Form -->
    <form class="search-filter-form">

      <!-- Search Input -->
      <input type="search" class="form-control" name="search" placeholder="Search Flick Archive">

      <!-- Genre Filter Dropdown -->
      <!-- The onchange attribute calls the form's submit() method when the value of the dropdown changes -->
      <select name="filter" onchange="this.form.submit()" class="form-select">

        <!-- Default option -->
        <!-- If a genre is selected, display the genre title, otherwise display "Select a Genre" -->
        <option value="">
          <?php 
          echo $selected_genre_id ? $genres[array_search($selected_genre_id, array_column($genres, 'genre_id'))]['genre_title'] : 'Select a Genre'; 
          ?>
        </option>

        <!-- Genre options -->
        <!-- Loop through each genre and display it as an option -->
        <?php foreach($genres as $genre): ?>
            <?php if($genre['genre_id'] != $selected_genre_id): ?>
                <option value="<?php echo $genre['genre_id']; ?>"><?php echo $genre['genre_title']; ?>
                </option>
            <?php endif; ?>
        <?php endforeach; ?>

      </select>

    </form>


    <!-- Movie Display Section -->
    <section class="movies">

      <!-- Movie -->
      <!-- Loop through each movie and display it -->
      <?php foreach($movies as $movie): ?>
        
        <div class="movie">

          <!-- Link to the movie details page -->
          <a href="show.php?id=<?php echo $movie['movie_id'] ?>" class="movie-link">

            <!-- Movie Poster -->
            <img src="<?php echo htmlspecialchars($movie['poster_url']); ?>" alt="Poster for <?php echo htmlspecialchars($movie['movie_title']); ?>">

            <!-- Display the movie title and rating -->
            <div class="movie-details">
              <span class="movie-title"><?php echo htmlspecialchars($movie['movie_title']); ?></span>
              <span class="movie-rating"><?php echo htmlspecialchars($movie['movie_rating']); ?></span>
            </div>

          </a>

        </div>
      <?php endforeach; ?>
    </section>
  </main>
  
  <?php require_once('footer.php'); ?>
</body>
</html>