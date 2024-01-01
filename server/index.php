<!--
  File Name: index.php
  Create Date: November 19, 2023
  Purpose: This file serves as the login page for the Flick Archive system. It handles user authentication by verifying login credentials against the database and directs authenticated users to the dashboard.
-->

<?php

// Start the session for user authentication
session_start();

// Include the database connection file
include 'db_connection.php';

// Variable to store login error messages
$loginError = '';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize the inputs to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query the database for the username
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    // Verify if the username exists and the password matches
    if (mysqli_num_rows($result) == 1) {

        // Fetch the user record
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row['password'])) {

            // Set the session variable and redirect to dashboard
            $_SESSION['username'] = $username;
          
            // Redirect to dashboard
            header("Location: ../server/dashboard.php");
            exit;
        }
    } 

    // Set the login error message if credentials are invalid
    $loginError = "<div class='error-message'>Invalid username or password</div>";
}
?>

<!-- HTML content here -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" type="text/css" href="http://localhost/Assignment 2/css/index.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/Assignment 2/css/global.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" />
    <title>Login</title>
</head>

<body>
    <div class="login">
      <div class="welcome-to-visitrack-parent">
        <h1 class="welcome-to-visitrack">Welcome to Flick Archive!</h1>
        <div class="login1">

          <div class="content">
            <div class="title">Login</div>
            <h1 class="welcome-back">Welcome back!</h1>
          </div>

          <!-- Login form -->
          <form id="loginForm" action="http://localhost/Assignment 2/server/index.php" method="post">

            <div class="login-input-div">

              <!-- Username and password input fields -->
              <div class="username">
                <div class="username1">Username</div>
                <input class="inputsmall" id="username" name="username" type="text" />
              </div>

              <!-- Display username error message -->
              <div id="usernameError"></div> 

              <!-- Password input field -->
              <div class="username">
                <div class="username1">Password</div>
                <input class="inputsmall" id="password" name="password" type="password" />
              </div>

              <!-- Display password error message -->
              <div id="passwordError"></div>

            </div>


    <!-- Display login error message -->
    <?php if (!empty($loginError)): ?>
        <?php echo $loginError; ?>
    <?php endif; ?>

            <!-- Login and sign-up buttons -->
            <div class="button-section">

              <div class="new-user-sign-up-container" id="newUserSignUp">
                <span class="new-user">New user?</span>
                <span class="span"> </span>
                <span class="sign-up">Sign-up</span>
              </div>
              
              <!-- Login button -->
              <button class="button" type="submit" onclick="return validateForm()">
                <div class="continue">Login</div>
              </button>

            </div>

          </form>
        </div>
      </div>
    </div>

    <!-- Script to validate login form -->
    <script src="http://localhost/Assignment 2/script.js" defer></script>

    <!-- Script to redirect to signup page -->
    <script>
      var newUserSignUp = document.getElementById("newUserSignUp");
      if (newUserSignUp) {
        newUserSignUp.addEventListener("click", function (e) {
          window.location.href = "./signup.php";
        });
      }
    </script>

  </body>

</html>

