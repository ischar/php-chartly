import { Chart, registerables } from "chart.js";
import calculateCurrent from "./calculate-current.js";

Chart.register(...registerables);

const distributionCtx = document
    .getElementById("distribution-chart")
    .getContext("2d");

const ctx = document.getElementById("summary-chart").getContext("2d");
const totalDiv = document.getElementById("summary-total");
const currentDiv = document.getElementById("summary-current");
const amountDiv = document.getElementById("summary-amount");

const data = await calculateCurrent();

const stockLabels = data.portfolios.map((portfolio) => portfolio.ticker);
const stockWeights = data.portfolios.map(
    (portfolio) => portfolio.stock_quantity
);

new Chart(distributionCtx, {
    type: "pie",
    data: {
        labels: stockLabels,
        datasets: [
            {
                label: "Portfolio Distribution",
                data: stockWeights,
                backgroundColor: [
                    "rgba(75, 192, 192, 0.8)",
                    "rgba(255, 87, 51, 0.8)",
                    "rgba(255, 193, 7, 0.8)",
                    "rgba(106, 90, 205, 0.8)",
                    "rgba(46, 204, 113, 0.8)",
                    "rgba(39, 55, 77, 0.8)",
                    "rgba(106, 90, 205, 0.8)",
                    "rgba(120, 144, 156, 0.8)",
                ],
            },
        ],
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: "bottom",
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        const label = context.label || "";
                        const value = context.raw || 0;
                        return `${label}: ${value}%`;
                    },
                },
            },
        },
    },
});

const total = ((data.current - data.amount) / data.amount) * 100;
const roundedTotal = Math.round(total * 100) / 100;

totalDiv.textContent = `${roundedTotal}%`;
currentDiv.textContent = `${data.current} USD`;
amountDiv.textContent = `${data.amount} USD`;

new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["Amount", "Current"],
        datasets: [
            {
                label: "Amount (USD)",
                data: [data.amount, data.current],
                backgroundColor: [
                    "rgba(255, 206, 86, 0.8)",
                    "rgba(75, 192, 192, 0.8)",
                ],
                yAxisID: "y",
            },
            {
                label: "Total (%)",
                data: [roundedTotal],
                type: "line",
                borderColor: "rgba(255, 99, 132, 1)",
                backgroundColor: "rgba(255, 99, 132, 1)",
                borderWidth: 2,
                yAxisID: "y1",
            },
        ],
    },
    options: {
        responsive: true,
        scales: {
            y: {
                type: "linear",
                position: "left",
                title: {
                    display: true,
                    text: "Amount (USD)",
                },
                ticks: {
                    beginAtZero: true,
                },
            },
            y1: {
                type: "linear",
                position: "right",
                title: {
                    display: true,
                    text: "Return (%)",
                },
                grid: {
                    drawOnChartArea: false,
                },
                ticks: {
                    beginAtZero: true,
                },
            },
        },
    },
});
