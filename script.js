/* 
File Name: script.js
Create Date: November 19, 2023
Purpose: This script provides client-side validation for a user registration form. It checks for empty usernames, password length, and matching passwords.
*/

// Wait for the DOM to be fully loaded before executing any script
document.addEventListener('DOMContentLoaded', function () {
    // Function to validate the username
    function validateUsername() {
        var username = document.getElementById("username").value;
        var errorDiv = document.getElementById("usernameError");

        // If the username field is empty, display an error message
        if (username === "") {
            errorDiv.textContent = "✘ Username cannot be empty.";
            errorDiv.style.color = "red";
            return false;
        } else {
            // Clear any error message if the username field is not empty
            errorDiv.textContent = "";
            return true;
        }

    }

    // Function to validate the password
    function validatePassword() {
        var password = document.getElementById("password").value;
        var errorDiv = document.getElementById("passwordError");

        // Check if the password is at least 4 characters long
        if (password.length < 4) {
            errorDiv.textContent = "✘ Password must be at least 4 characters long.";
            errorDiv.style.color = "red";
            return false;
        } else {
            // Clear any error message if the password is valid
            errorDiv.textContent = "";
            return true;
        }

    }

    // Function to validate the confirm password field
    function validateConfirmPassword() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmPassword").value;
        var errorDiv = document.getElementById("confirmPasswordError");

        // Check if the password and confirm password fields match
        if (password !== confirmPassword || confirmPassword === "") {
            errorDiv.textContent = "✘ Passwords do not match.";
            errorDiv.style.color = "red";
            return false;
        } else {
            // Clear any error message if the passwords match
            errorDiv.textContent = "";
            return true;
        }

    }

    // Add event listeners to input fields to validate on user input
    document.getElementById("username").addEventListener("input", validateUsername);
    document.getElementById("password").addEventListener("input", validatePassword);
    document.getElementById("confirmPassword").addEventListener("input", validateConfirmPassword);

    // Set the form onsubmit event handler
    document.getElementById("signupForm").onsubmit = function () {
        // Check all validations before submitting the form
        return validateUsername() && validatePassword() && validateConfirmPassword();
    };
});
