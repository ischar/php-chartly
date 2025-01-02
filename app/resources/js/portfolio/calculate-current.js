export default async function calculateCurrent() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const response = await fetch("/portfolio/summary", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
    });

    const data = await response.json();
    let amount = 0;
    let current = 0;

    if (data.error) {
        return null;
    }

    for (const portfolio of data) {
        amount += portfolio.stock_price * portfolio.stock_quantity;
        current += portfolio.current_price * portfolio.stock_quantity;
    }

    return { portfolios: data, amount: amount, current: current };
}
