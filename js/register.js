$(document).ready(function () {
  $('#registerForm').on('submit', function (e) {
    e.preventDefault();

    const userData = {
      username: $('#username').val(),
      password: $('#password').val(),
      email: $('#email').val(),
      dob: $('#dob').val(),
      contact: $('#contact').val()
    };

    $.ajax({
      url: 'php/register.php',
      type: 'POST',
      data: userData,
      success: function (response) {
        alert(response);
        window.location.href = 'login.html';
      },
      error: function () {
        alert('Registration failed!');
      }
    });
  });
});
