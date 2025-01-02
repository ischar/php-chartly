import { Trie } from "./trie";

const trie = new Trie();

const loadStockData = async () => {
    try {
        const response = await fetch("api/nasdaq-stocks");
        const stocks = await response.json();

        stocks.forEach((stock) => {
            trie.insert(stock.Name);
        });
    } catch (error) {
        console.error("Error loading stock data:", error);
    }
};

loadStockData();

document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("new-stock-search");
    const suggestionsList = document.getElementById("new-stock-suggestions");

    function updateInputStyle() {
        if (suggestionsList.children.length > 0) {
            searchInput.classList.remove("rounded-xl");
            searchInput.classList.add("rounded-t-xl");
        } else {
            searchInput.classList.remove("rounded-t-xl");
            searchInput.classList.add("rounded-xl");
        }
    }

    const observer = new MutationObserver(updateInputStyle);

    observer.observe(suggestionsList, {
        childList: true,
    });

    updateInputStyle();
});

document
    .getElementById("new-stock-search")
    .addEventListener("input", (event) => {
        const query = event.target.value.trim().toUpperCase();
        const suggestions = trie.search(query);
        const suggestionsContainer = document.querySelector(".relative ul");
        suggestionsContainer.innerHTML = "";

        suggestions.slice(0, 10).forEach((suggestion) => {
            const suggestionItem = document.createElement("li");
            suggestionItem.className =
                "hover:bg-gray-100 active:bg-gray-200 px-4 py-2 cursor-pointer";
            suggestionItem.textContent = suggestion;

            suggestionItem.addEventListener("click", async () => {
                document.getElementById("new-stock-search").value = suggestion;
                document.getElementById("new-stock-name").value = suggestion;
                suggestionsContainer.innerHTML = "";
            });

            suggestionsContainer.appendChild(suggestionItem);
        });
    });
    
