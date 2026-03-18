// Data for the chart
const data = {
    labels: ['This Week', 'This Month', 'This Year'],
    datasets: [{
        label: 'Total System Views',
        data: [10, 3, 0.12], // Replace with your actual data
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 2,
        fill: false,
    }]
};

// Configuration options
const options = {
    scales: {
        y: {
            beginAtZero: true,
            title: {
                display: true,
                text: 'Percentage (%)'
            }
        }
    }
};

// Get the canvas element and create the chart
const ctx = document.getElementById('viewsChart').getContext('2d');
const lineChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: options
});
