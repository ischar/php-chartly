import { stockMap } from "./data.js";

document.addEventListener("DOMContentLoaded", () => {
    const button = document.getElementById("new-stock-button");
    button.addEventListener("click", () => {
        const name = document.getElementById("new-stock-name");
        const price = document.getElementById("new-stock-price");
        const quantity = document.getElementById("new-stock-quantity");
        const csrfToken = document.querySelector(
            'meta[name="csrf-token"]'
        ).content;
        
        fetch("/portfolio", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({
                stock_name: name.value,
                stock_price: price.value,
                ticker: stockMap.get(name.value),
                stock_quantity: quantity.value,
                
            }),
        })
            .then((response) => {
                if (response.ok) {
                    location.reload();
                } else {
                    alert("Failed to add portfolio");
                }
            })
            .catch((error) => console.error("Error:", error));
    });
});
