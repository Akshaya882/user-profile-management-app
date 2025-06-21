$(document).ready(function () {
  const email = localStorage.getItem("email");
  console.log("Email from localStorage:", email); // for debugging

  if (!email) {
    alert("You are not logged in");
    window.location.href = "index.html";
    return;
  }

  // Fetch profile data
  $.ajax({
    url: "php/profile.php",
    type: "POST",
    data: { email: email },
    success: function (response) {
      console.log("Response:", response);

      if (response.error) {
        alert(response.error);
      } else {
        $("#email").val(response.email);
        $("#dob").val(response.dob);
        $("#contact").val(response.contact);
      }
    },
    error: function () {
      alert("Failed to load profile");
    }
  });

  // Update profile
  $("#updateBtn").click(function () {
    const dob = $("#dob").val();
    const contact = $("#contact").val();

    $.ajax({
      url: "php/update.php",
      type: "POST",
      data: { email: email, dob: dob, contact: contact },
      success: function (res) {
        if (res.success) {
          alert("Profile updated!");
        } else {
          alert(res.error || "Update failed");
        }
      },
      error: function () {
        alert("Update AJAX error");
      }
    });
  });

  // Logout
  $("#logoutBtn").click(function () {
    localStorage.removeItem("email");
    window.location.href = "index.html";
  });
});
