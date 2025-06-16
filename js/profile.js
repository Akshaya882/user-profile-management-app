$(document).ready(function () {
  const username = localStorage.getItem("username");

  if (!username) {
    alert("Please login first.");
    window.location.href = "login.html";
  }

  $('#username-display').text(username);

  // Load profile data from MongoDB
  $.ajax({
    url: 'php/profile.php',
    type: 'POST',
    data: { username: username },
    success: function (response) {
      console.log("Fetched profile:", response); // 🔍 Debug
      const data = JSON.parse(response);
      $('#email').val(data.email);
      $('#dob').val(data.dob);
      $('#contact').val(data.contact);
    }
  });

  // Handle profile update
  $('#profileForm').submit(function (e) {
    e.preventDefault();

    const updatedData = {
      username: username,
      email: $('#email').val(),
      dob: $('#dob').val(),
      contact: $('#contact').val()
    };

    console.log("Sending updated data:", updatedData); // 🔍 Debug

    $.ajax({
      url: 'php/update.php',
      type: 'POST',
      data: updatedData,
      success: function (res) {
        alert(res); // Expect: Profile updated successfully!
      },
      error: function () {
        alert("Update request failed.");
      }
    });
  });

  // Logout button
  $('#logout').click(function () {
    localStorage.removeItem("username");
    window.location.href = "login.html";
  });
});
