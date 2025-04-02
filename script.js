document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form from refreshing the page

    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    
    fetch("http://localhost/water-refill-pos/api/login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ email: email, password: password })
    })
    .then(response => response.json())
    .then(data => {
        let message = document.getElementById("message");
        if (data.message === "Login successful") {
            message.style.color = "green";
            message.textContent = "Login successful! Redirecting...";
            localStorage.setItem("user", JSON.stringify(data.user)); // Save user info
            setTimeout(() => window.location.href = "dashboard.html", 1500);
        } else {
            message.style.color = "red";
            message.textContent = data.message;
        }
    })
    .catch(error => console.error("Error:", error));
});
