// Data for Hib and Hepatitis B vaccination coverage
        const data = {
            labels: ["BCG", "OPV"],
            datasets: [
                {
                    label: "Global Coverage (%)",
                    data: [76, 84],
                    backgroundColor: ["rgba(75, 192, 192, 0.5)", "rgba(255, 99, 132, 0.5)"],
                    borderColor: ["rgba(75, 192, 192, 1)", "rgba(255, 99, 132, 1)"],
                    borderWidth: 1,
                },
            ],
        };

        // Create a bar chart
        const ctx = document.getElementById("vaccinationChart").getContext("2d");
        const myChart = new Chart(ctx, {
            type: "bar",
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100, // Set the maximum value to 100%
                    },
                },
            },
        });