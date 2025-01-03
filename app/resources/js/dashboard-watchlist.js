async function fetchWatchList() {
    try {
        const response = await fetch("/api/watchlist/getRecentWatchlists");
        const watchList = await response.json();
        const watchListDiv = document.getElementById("watch-list");
        watchList.forEach((stock) => {
            const stockCard = document.createElement("div");
            const changeClass =
                stock.change >= 0
                    ? "text-blue-400 dark:text-blue-500"
                    : "text-red-400 dark:text-red-500";
            const changeSymbol = stock.change > 0 ? "+" : "";
            stockCard.className =
                "stock-card w-full p-4 bg-light-bg-card dark:bg0dark-bg-card rounded-lg";

            stockCard.innerHTML = `
              <h3 class="text-lg font-semibold line-clamp-2 text-light-fg-primary dark:text-dark-fg-primary">${stock.stock_name}</h3>
              <p class="inline px-2 py-1 rounded-lg text-[12px] font-bold text-light-fg-primary dark:text-dark-fg-primary bg-light-fg-button">${stock.ticker}</p>
              <div class="flex flex-row justify-end items-center mt-2 space-x-4 text-lg font-semibold">
                <p class="text-light-fg-primary dark:text-dark-fg-primary">${stock.current_price} USD</p>
                <span class="${changeClass}">
                  ${changeSymbol}${stock.change}%              
                </span>            
            </div>


        `;
            watchListDiv.appendChild(stockCard);
        });
    } catch (error) {
        console.error("Error loading watchlist data:", error);
    }
}

fetchWatchList();
