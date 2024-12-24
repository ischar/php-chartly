document.addEventListener("DOMContentLoaded", function () {
    const nasdaqDataDiv = document.getElementById("nasdaq-data");

    async function fetchNasdaqData() {
        try {
            const response = await fetch("/api/nasdaq");
            const data = await response.json();

            if (data.error) {
                nasdaqDataDiv.innerHTML = `<p>Error: ${data.error}</p>`;
            } else {
                const { currentPrice, changePercent } = data;
                const changeClass =
                    changePercent >= 0 ? "text-green-500" : "text-red-500";
                nasdaqDataDiv.innerHTML = `
                    <div class="flex flex-row font-semibold text-lg text-light-fg-primary dark:text-dark-fg-primary">
                        <h3>QQQ: ${currentPrice} USD</h3>
                        <p class="${changeClass} ml-2">${changePercent}</p>
                    </div>

                `;
            }
        } catch (error) {
            console.error("Error fetching Nasdaq data:", error);
            nasdaqDataDiv.innerHTML = "<p>Error fetching data</p>";
        }
    }

    fetchNasdaqData();
});
