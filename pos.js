document.addEventListener("DOMContentLoaded", function () {
    loadCustomers();
    fetchRecentSales();
});

function loadCustomers() {
    fetch("api/get-customers.php")
        .then(response => response.json())
        .then(data => {
            let customerDropdown = document.getElementById("customer");
            customerDropdown.innerHTML = "";
            data.forEach(customer => {
                let option = document.createElement("option");
                option.value = customer.id;
                option.textContent = customer.name;
                customerDropdown.appendChild(option);
            });
        });
}

function calculateTotal() {
    let quantity = document.getElementById("quantity").value;
    let price = document.getElementById("price").value;
    let total = quantity * price;
    document.getElementById("total").textContent = total;
}

function processSale() {
    let customerId = document.getElementById("customer").value;
    let quantity = document.getElementById("quantity").value;
    let price = document.getElementById("price").value;
    let total = quantity * price;

    console.log("Sending Data:", { customer_id: customerId, amount: total });

    fetch("api/process-sale.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `customer_id=${encodeURIComponent(customerId)}&amount=${encodeURIComponent(total)}`
    })
    .then(response => response.text()) // Log raw response first
    .then(data => {
        console.log("Raw Response:", data);
        let jsonData;
        try {
            jsonData = JSON.parse(data); // Try parsing JSON
            alert(jsonData.message);
        } catch (error) {
            console.error("Invalid JSON Response:", data);
        }
    })
    .catch(error => console.error("Fetch Error:", error));
}



function fetchRecentSales() {
    fetch("api/fetch-sales.php")
    .then(response => response.json()) 
    .then(sales => {
        let salesTable = document.getElementById("recent-sales");

        // Check if the sales table exists
        if (!salesTable) {
            console.error("Error: Element with id 'recent-sales' not found.");
            return;
        }

        salesTable.innerHTML = ""; // Clear existing data

        sales.forEach(sale => {
            let row = document.createElement("tr"); // Create a new row
            row.innerHTML = `
                <td>${sale.id}</td>
                <td>${sale.customer_name}</td>
                <td>${sale.amount}</td>
                <td>${sale.date}</td>
            `;
            salesTable.appendChild(row);
        });

        console.log("Sales data inserted into table.");
    })
    .catch(error => console.error("Fetch Error:", error));
}

// Ensure the function runs when the page loads
document.addEventListener("DOMContentLoaded", fetchRecentSales);


// Call the function when the page loads
document.addEventListener("DOMContentLoaded", fetchRecentSales);


