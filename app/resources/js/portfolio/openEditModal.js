export default function openEditModal(portfolio) {
    const modal = document.createElement("div");
    modal.className =
        "fixed inset-0 flex items-center justify-center bg-black bg-opacity-50";
    const modalContent = document.createElement("div");
    modalContent.className = "bg-white p-6 rounded shadow-lg w-80 space-y-4";

    const title = document.createElement("h2");
    title.textContent = `Edit ${portfolio.ticker}`;
    title.className = "text-lg font-bold";
    modalContent.appendChild(title);

    const quantityInput = document.createElement("input");
    quantityInput.type = "number";
    quantityInput.value = portfolio.stock_quantity;
    quantityInput.placeholder = "Please input Quantity.";

    quantityInput.className = "w-full p-2 border rounded";
    modalContent.appendChild(quantityInput);

    const priceInput = document.createElement("input");
    priceInput.type = "number";
    priceInput.value = portfolio.stock_price;
    priceInput.placeholder = "Please input Price.";
    priceInput.className = "w-full p-2 border rounded";
    modalContent.appendChild(priceInput);

    const buttonContainer = document.createElement("div");
    buttonContainer.className = "flex justify-end space-x-2";

    const saveButton = document.createElement("button");
    saveButton.textContent = "Save";
    saveButton.className =
        "px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700";
    saveButton.addEventListener("click", async () => {
        portfolio.stock_quantity = Number(quantityInput.value);
        portfolio.stock_price = Number(priceInput.value);

        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const response = await fetch(`/portfolio/edit/${portfolio.ticker}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
          },
          body: JSON.stringify({
            stock_price: portfolio.stock_price,
            stock_quantity: portfolio.stock_quantity,
          })
        });

        const row = document.querySelector(
            `tr[data-ticker="${portfolio.ticker}"]`
        );
        if (row) {
            const cells = row.querySelectorAll("td");
            cells[1].textContent = portfolio.quantity; 
            cells[2].textContent = portfolio.price; 
        }
        modal.remove();
        location.reload()
    });
    buttonContainer.appendChild(saveButton);

    const cancelButton = document.createElement("button");
    cancelButton.textContent = "Cancel";
    cancelButton.className =
        "px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700";
    cancelButton.addEventListener("click", () => {
        modal.remove();
    });
    buttonContainer.appendChild(cancelButton);

    modalContent.appendChild(buttonContainer);
    modal.appendChild(modalContent);
    document.body.appendChild(modal);
}
