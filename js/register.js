$(document).ready(function () {
    $("#registerBtn").click(function () {
        const username = $("#username").val();
        const email = $("#email").val();
        const password = $("#password").val();
        const dob = $("#dob").val();
        const contact = $("#contact").val();

        $.ajax({
            url: "php/register.php",
            type: "POST",
            data: {
                username,
                email,
                password,
                dob,
                contact
            },
            success: function (response) {
                console.log("Server response:", response);

                if (response.trim() === "success") {
                    alert("Registration successful!");
                    window.location.href = "index.html"; // redirect to login
                } else {
                    alert("Server Error: " + response);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", xhr.responseText || error);
                alert("Something went wrong during registration.");
            }
        });
    });
});
