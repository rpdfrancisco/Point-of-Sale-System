// Check if user is logged in
let user = JSON.parse(localStorage.getItem("user"));

if (!user) {
    window.location.href = "login.html"; // Redirect if not logged in
} else {
    // Display user details
    document.getElementById("username").textContent = user.name;
    document.getElementById("useremail").textContent = user.email;
    document.getElementById("userrole").textContent = user.role;

    // Hide all role panels by default
    document.getElementById("admin-panel").style.display = "none";
    document.getElementById("cashier-panel").style.display = "none";
    document.getElementById("customer-panel").style.display = "none";

    // Show the correct panel based on role
    if (user.role === "admin") {
        document.getElementById("admin-panel").style.display = "block";
    } else if (user.role === "cashier") {
        document.getElementById("cashier-panel").style.display = "block";
    } else if (user.role === "customer") {
        document.getElementById("customer-panel").style.display = "block";
    }
}

// Logout function
document.getElementById("logoutBtn").addEventListener("click", function() {
    localStorage.removeItem("user"); // Clear user session
    window.location.href = "login.html"; // Redirect to login page
});
