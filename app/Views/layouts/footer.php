</main>

</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

<script>

document.addEventListener("DOMContentLoaded", function () {

    // Recovery Analytics Chart

    const recoveryCanvas = document.getElementById('recoveryChart');

    if (recoveryCanvas) {

        new Chart(recoveryCanvas, {

            type: 'line',

            data: {

                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],

                datasets: [{

                    label: 'Recovery Progress',

                    data: [45, 52, 60, 68, 75, 83, 91],

                    borderColor: '#14b8a6',

                    backgroundColor: 'rgba(20,184,166,.15)',

                    fill: true,

                    tension: .4,

                    borderWidth: 3,

                    pointRadius: 4

                }]

            },

            options: {

                responsive: true,

                plugins: {

                    legend: {

                        labels: {

                            color: '#cbd5e1'

                        }

                    }

                },

                scales: {

                    x: {

                        ticks: {

                            color: '#94a3b8'

                        },

                        grid: {

                            color: 'rgba(255,255,255,.05)'

                        }

                    },

                    y: {

                        ticks: {

                            color: '#94a3b8'

                        },

                        grid: {

                            color: 'rgba(255,255,255,.05)'

                        }

                    }

                }

            }

        });

    }

    // Patient Conditions Chart

    const conditionCanvas = document.getElementById('conditionChart');

    if (conditionCanvas) {

        new Chart(conditionCanvas, {

            type: 'doughnut',

            data: {

                labels: [

                    'ACL Injury',
                    'Rotator Cuff',
                    'Back Pain',
                    'Other'

                ],

                datasets: [{

                    data: [35, 25, 20, 20],

                    backgroundColor: [

                        '#14b8a6',
                        '#0ea5e9',
                        '#8b5cf6',
                        '#f59e0b'

                    ],

                    borderWidth: 0

                }]

            },

            options: {

                responsive: true,

                plugins: {

                    legend: {

                        labels: {

                            color: '#cbd5e1'

                        }

                    }

                }

            }

        });

    }

});

</script>

</body>
</html>