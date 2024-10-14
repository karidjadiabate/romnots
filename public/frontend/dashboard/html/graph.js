document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('myChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['test1', 'test2', 'test3', 'test4', 'test5', 'test6'],
            datasets: [{
                label: '',
                data: [2, 8, 14, 20, 25, 27],
                backgroundColor: [
                    '#F19D2E',
                    '#423AB0',
                    '#F19D2E',
                    '#423AB0',
                    '#F19D2E',
                    '#423AB0'
                ],
                borderColor: [
                    '#F19D2E',
                    '#423AB0',
                    '#F19D2E',
                    '#423AB0',
                    '#F19D2E',
                    '#423AB0'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                datalabels: {
                    display: false
                }
            }
        },
        plugins: [{
            beforeDatasetsDraw: function (chart, easing) {
                const ctx = chart.ctx;
                chart.data.datasets.forEach(function (dataset, i) {
                    const meta = chart.getDatasetMeta(i);
                    meta.data.forEach(function (bar, index) {
                        const data = dataset.data[index];
                        ctx.save();
                        ctx.fillStyle = dataset.backgroundColor[index];
                        ctx.fillRect(bar.x - 5, bar.y, 10, chart.chartArea.bottom - bar.y);
                        ctx.restore();
                    });
                });
            }
        }]
    });
});