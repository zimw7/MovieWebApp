<!--
  File Name: signup.php
  Create Date: November 19, 2023
  Purpose: This script handles the user sign-up process for the 'Flick Archive' website. It validates the user inputs and inserts the new user data into the database.
-->

<?php

// Include the database connection scrip
include 'db_connection.php';

// Used to enable the display of errors directly on the web page
ini_set('display_errors', 1);

// Ensure that PHP is set to report all errors
error_reporting(E_ALL);

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize user inputs to prevent SQL injection
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['newpassword']);
  
  // Hash the password for secure storage
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Check if the username already exists in the database
  $query = "SELECT * FROM users WHERE username='$username'";

  // Execute the query and store the results
  $result = mysqli_query($conn, $query);

  // Check if the username exists
  if (mysqli_num_rows($result) > 0) {

      // Username exists, show an error message
      echo "Username already exists";

  } else {

      // Insert new user data into the database
      $insert_query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
      if (mysqli_query($conn, $insert_query)) {

          // Start a new session and redirect to the dashboard
          session_start();
          $_SESSION['username'] = $username;
          header("Location: index.php");
          exit;
      } else {

          // Display an error if the query fails
          echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
      }
  }
}

?>

<!-- HTML code for the sign-up page -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <title>Sign-up</title>

    <!-- Linking external CSS for styling -->
    <link rel="stylesheet" type="text/css" href="http://localhost/Assignment 2/css/signup.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/Assignment 2/css/global.css">
  
    <!-- Bootstrap CSS for responsive design -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">

    <!-- Google Fonts link for typography -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" />
</head>

<body>

  <div class="signup">

    <div class="welcome-to-visitrack-group">

      <!-- Welcome message -->
      <h1 class="welcome-to-visitrack1">
        Welcome to Flick Archive!
      </h1>

      <!-- Sign-up form container -->
      <div class="component-1">

        <div class="content1">
          <div class="sign-up1">Sign-up</div>
          <div class="hi-new-user">Hi, new user!</div>
        </div>

        <!-- Sign-up form with action and method attributes -->
        <form id="signupForm" action="http://localhost/Assignment 2/server/signup.php" method="post">
            <div class="signup-input-div">

              <!-- Input field for username -->
              <div class="newpassword">
                <div class="username3">Username</div>
                <input class="inputsmall7" id="username" name="username" type="text" />
              </div>

              <!-- Error message for username -->
              <div id="usernameError"></div>

              <!-- Input field for new password -->
              <div class="newpassword">
                <div class="username3">
                  <p class="new">New</p>
                  <p class="new">Password</p>
                </div>
                <input class="inputsmall7" id="password" name="newpassword" type="password" />
              </div>

              <!-- Error message for password -->
              <div id="passwordError"></div>

              <!-- Input field for confirming password -->
              <div class="newpassword">
                <div class="username3">
                  <p class="new">Confirm</p>
                  <p class="new">password</p>
                </div>
                <input class="inputsmall7" id="confirmPassword" name="confirmpassword" type="password" />
              </div>

              <!-- Error message for confirming password -->
              <div id="confirmPasswordError"></div>

            </div>

            <!-- Button section for sign-up -->
            <div class="button-section1">
              <div class="new-user-sign-up-container1" id="newUserSignUp">
                <span>←Back to </span>
                <span class="login2">Login</span>
              </div>

              <!-- Sign-up button -->
              <button class="button5">
                <div class="continue5">Sign-up</div>
              </button>
            </div>
        </form>
      </div>
    </div>

    <!-- JavaScript for form validation -->
    <script src="http://localhost/Assignment 2/script.js" defer></script>

    <!-- JavaScript for redirecting to login page -->
    <script>

        // Get the element
        var newUserSignUp = document.getElementById("newUserSignUp");

        // Add an event listener to the element
        if (newUserSignUp) {
            newUserSignUp.addEventListener("click", function (e) {
                window.location.href = "http://localhost/Assignment 2/server/index.php";
            });
        }
    </script>

  </div>
    
</body>
</html>
