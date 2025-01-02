import { Trie } from "./trie.js";

export const trie = new Trie();
export const stockMap = new Map();

export const loadStockData = async () => {
    try {
        const response = await fetch("api/nasdaq-stocks");
        const stocks = await response.json();

        stocks.forEach((stock) => {
            trie.insert(stock.Name);
            stockMap.set(stock.Name, stock.Symbol);
        });
    } catch (error) {
        console.error("Error loading stock data:", error);
    }
};
