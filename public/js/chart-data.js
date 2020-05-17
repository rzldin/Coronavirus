'use strict';
// load indonesia chart
const loadIndonesiaChart = function(data) {
    // card canvas
    const cardCanvas = document.querySelector('.card.data-chart');
    let chartDate = [];
    let chartTotalCases = [];
    let chartPositive = [];
    let chartRecovered = [];
    let chartDeaths = [];
    let index = 0;
    for (index in data) {
        chartDate.push(data[index].updated);
        chartTotalCases.push(data[index].total);
        chartPositive.push(data[index].positive);
        chartRecovered.push(data[index].recovered);
        chartDeaths.push(data[index].deaths);
    }
    cardCanvas.children[0].children[0].toggleAttribute('style', true);
    cardCanvas.children[0].children[0].setAttribute('style', 'height: 250px;');
    cardCanvas.children[0].children[0].innerHTML = '<canvas class="data-chart"></canvas>';
    // chart canvas
    const chartCanvas = document.querySelector('canvas.data-chart').getContext('2d');
    let chart = null;
    if (chart !== null) { chart.destroy() }
    chart = new Chart(chartCanvas, {
        type: 'line',
        data: {
            labels: chartDate,
            datasets: [{
                    label: 'Total Cases',
                    backgroundColor: '#17a2b8',
                    borderColor: '#17a2b8',
                    data: chartTotalCases,
                    fill: false
                },
                {
                    label: 'Active',
                    backgroundColor: '#ffc107',
                    borderColor: '#ffc107',
                    data: chartPositive,
                    fill: false
                },
                {
                    label: 'Recovered',
                    backgroundColor: '#28a745',
                    borderColor: '#28a745',
                    data: chartRecovered,
                    fill: false
                },
                {
                    label: 'Deaths',
                    backgroundColor: '#dc3545',
                    borderColor: '#dc3545',
                    data: chartDeaths,
                    fill: false
                }
            ]
        },
        options: {
            animation: {
                duration: 2500
            },
            maintainAspectRatio: false,
            tooltips: {
                mode: 'index',
                intersect: false,
                caretSize: 0,
                titleMarginBottom: 10,
                bodySpacing: 5,
                multiKeyBackground: 'rgba(0, 0, 0, 0)',
                callbacks: {
                    title: function(tooltipItem, data) {
                        return moment(data.labels[tooltipItem[0].index]).format('DD MMMM YYYY');
                    },
                    label: function(tooltipItem, data) {
                        let label = data.datasets[tooltipItem.datasetIndex].label || '';
                        if (label) { label += ': ' }
                        label += numeral(tooltipItem.value).format('0,0');
                        return label;
                    },
                    labelColor: function(tooltipItem, chart) {
                        let color = chart.data.datasets[tooltipItem.datasetIndex].borderColor;
                        return {
                            borderColor: 'rgba(0, 0, 0, 0)',
                            backgroundColor: color
                        };
                    }
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        stepSize: 2000,
                        callback: function(value) {
                            return numeral(value).format('0a');
                        }
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    }
                }],
                xAxes: [{
                    type: 'time',
                    time: {
                        unit: 'day',
                        displayFormats: {
                            day: 'MMM DD'
                        }
                    },
                    gridLines: {
                        drawBorder: false
                    }
                }]
            }
        }
    });
};