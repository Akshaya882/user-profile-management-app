$(document).ready(function () {
    $("#loginBtn").click(function () {
        const email = $("#email").val();
        const password = $("#password").val();

        if (!email || !password) {
            alert("Please enter both email and password.");
            return;
        }

        $.ajax({
            url: "php/login.php",
            type: "POST",
            data: {
                email: email,
                password: password
            },
            success: function (response) {
                console.log("Login response:", response);

                if (response.trim() === "success") {
                    alert("Login successful!");
                    localStorage.setItem("email", email);
                    window.location.href = "profile.html";
                } else {
                    alert("Invalid credentials. Please try again.");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", xhr.responseText || error);
                alert("An error occurred during login.");
            }
        });
    });
});
