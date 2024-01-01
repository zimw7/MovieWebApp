<!--
  File Name: header.php
  Create Date: November 19, 2023
  Purpose: This file is used to create the header for the dashboard, new movie, and movie detail pages.
-->

<header class="header">
  <!-- Header Title -->
  <h1 class="header-title">
    <!-- Link to the dashboard page, styled to inherit color and no text decoration -->
    <a href="dashboard.php" style="color: inherit; text-decoration: none;">Flick Archive</a>
  </h1>

  <!-- Navigation Bar -->
  <nav class="nav">
    <!-- Link to the all movies page -->
    <a class="nav-link" href="dashboard.php">All Movies</a>
    <!-- Link to the add new movie page -->
    <a class="nav-link" href="new.php">Add Movie</a>
    <!-- Link for signing out, redirects to the sign-in page -->
    <a class="nav-link" href="index.php">Sign Out</a> 
  </nav>
</header>
