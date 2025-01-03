import { Chart, registerables } from "chart.js";
import calculateMonthly from "./calculate-monthly";
import openEditModal from "./openEditModal.js";
import deleteImg from "../../../public/Images/icons/delete-stock.png";

Chart.register(...registerables);

const ctx = document.getElementById("monthly-chart").getContext("2d");
const data = await calculateMonthly();
const stockDiv = document.getElementById("monthly-stocks");

stockDiv.innerHTML = "";

data.portfolios.forEach((portfolio) => {
    const row = document.createElement("tr");

    Object.values(portfolio).forEach((value) => {
        const cell = document.createElement("td");
        cell.textContent = value;
        cell.className = "p-2";
        row.appendChild(cell);
    });

    const deleteCell = document.createElement("td");
    const deleteButton = document.createElement("button");
    const deleteImage = document.createElement("img");

    deleteImage.src = deleteImg;
    deleteImage.alt = "Delete";
    deleteImage.className = "w-4 h-4";
    deleteButton.appendChild(deleteImage);
    deleteButton.className =
        "px-2 py-1 bg-red-500 text-white rounded hover:bg-red-700";
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    deleteButton.addEventListener("click", async () => {
        const response = await fetch(`portfolio/${portfolio.ticker}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
        });
        row.remove();
    });
    deleteCell.appendChild(deleteButton);
    row.appendChild(deleteCell);

    const editCell = document.createElement("td");
    const editButton = document.createElement("button");

    editButton.textContent = "Edit";
    editButton.className =
        "px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-700";
    editButton.addEventListener("click", () => {
        console.log(`Editing row for ${portfolio.ticker}`);
        openEditModal(portfolio);
    });
    editCell.appendChild(editButton);
    row.appendChild(editCell);

    stockDiv.appendChild(row);
});

const labels = data.portfolios.map((portfolio) => portfolio.ticker);
const values = data.portfolios.map((portfolio) => portfolio.profit);
new Chart(ctx, {
    type: "bar",
    data: {
        labels: labels,
        datasets: [
            {
                data: values,
                backgroundColor: [
                    "rgba(59, 130, 246, 0.8)",
                    "rgba(128, 128, 128, 0.6)",
                    "rgba(128, 128, 128, 0.6)",
                    "rgba(128, 128, 128, 0.6)",
                    "rgba(128, 128, 128, 0.6)",
                ],
                borderWidth: 0,
            },
        ],
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false,
                position: "top",
            },
            tooltip: {
                enabled: false,
            },
            datalabels: {
                display: true,
                align: "end",
                anchor: "end",
                formatter: (value) => value,
            },
        },
        scales: {
            x: {
                title: {
                    display: false,
                    text: "Stocks",
                },
                grid: {
                    drawBorder: false,
                    display: false,
                },
            },
            y: {
                beginAtZero: true,
                title: {
                    display: false,
                    text: "Value",
                },
                grid: {
                    drawBorder: false,
                    display: false,
                },
                ticks: {
                    display: false,
                },
            },
        },
    },
    plugins: [
        {
            id: "dataLabels",
            beforeDraw: (chart) => {
                const ctx = chart.ctx;
                chart.data.datasets.forEach((dataset, i) => {
                    const meta = chart.getDatasetMeta(i);
                    meta.data.forEach((bar, index) => {
                        const value = dataset.data[index];
                        const yPosition =
                            value < 0 ? bar.bottom + 15 : bar.top - 5;
                        ctx.fillStyle = "black";
                        ctx.textAlign = "center";
                        ctx.font = "12px";

                        ctx.fillText(value, bar.x, yPosition);
                    });
                });
            },
        },
    ],
});
