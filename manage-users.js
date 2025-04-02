document.addEventListener("DOMContentLoaded", function () {
    fetchUsers();
});

function fetchUsers() {
    fetch("api/get-users.php")
        .then(response => response.json())
        .then(data => {
            let userTable = document.querySelector("#userTable tbody");
            userTable.innerHTML = "";

            data.forEach(user => {
                let row = `<tr>
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.role}</td>
                    <td>
                        <button onclick="deleteUser(${user.id})">Delete</button>
                    </td>
                </tr>`;
                userTable.innerHTML += row;
            });
        });
}

function addUser() {
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let role = document.getElementById("role").value;

    if (name === "" || email === "" || password === "") {
        alert("All fields are required!");
        return;
    }

    fetch("api/add-user.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}&role=${role}`
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.message === "User added successfully") {
            document.getElementById("name").value = "";
            document.getElementById("email").value = "";
            document.getElementById("password").value = "";
            fetchUsers();
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
}


function deleteUser(id) {
    if (confirm("Are you sure you want to delete this user?")) {
        fetch("api/delete-user.php?id=" + id, { method: "GET" })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                fetchUsers();
            });
    }
}
