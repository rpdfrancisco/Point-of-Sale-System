document.addEventListener("DOMContentLoaded", function () {
    fetchSales();
});

function fetchSales() {
    fetch("api/fetch-sales.php")
        .then(response => response.json())
        .then(data => {
            let salesTable = document.querySelector("#salesTable tbody");
            salesTable.innerHTML = "";

            data.forEach(sale => {
                let row = `<tr>
                    <td>${sale.id}</td>
                    <td>${sale.customer_name}</td>
                    <td>₱${sale.amount}</td>
                    <td>${sale.date}</td>
                </tr>`;
                salesTable.innerHTML += row;
            });
        });
}
