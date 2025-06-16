$(document).ready(function () {
  $('#loginForm').submit(function (e) {
    e.preventDefault(); // Prevent default form submission

    const loginData = {
      username: $('#username').val(),
      password: $('#password').val()
    };

    // Send AJAX request to PHP
    $.ajax({
      url: 'php/login.php',
      type: 'POST',
      data: loginData,
      success: function (response) {
        console.log("Server response:", response); // Debugging output

        // Trim to remove whitespace/newlines
        if (response.trim() === "success") {
          // Store username in localStorage
          localStorage.setItem("username", loginData.username);
          alert("Login successful!");
          window.location.href = "profile.html"; // Redirect
        } else {
          alert(response); // Show error from PHP
        }
      },
      error: function () {
        alert("Login request failed."); // AJAX failure
      }
    });
  });
});
