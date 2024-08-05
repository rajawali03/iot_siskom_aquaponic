<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Monitoring Sensor Laravel</title>

    {{-- panggil file jquery untuk proses realtime --}}
    <script type="text/javascript" src="{{ ('jquery/jquery.min.js') }}"></script>

    {{-- ajax untuk realtime --}}
    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function() {
                $("#sisa_makanan").load("{{ url('baca_sisamakanan') }}", function() {
                    updateChart();
                });
                $("#kekeruhan").load("{{ url('baca_kekeruhan') }}");
            }, 1000);   //1000ms = 1s
        });
    </script>
</head>
<style>
    header {
        background-color: #000080;
        color: white;
        text-align: center;
        padding: 10px;
    }
    .box2 {
        border-radius: 20px;
        display: flex;
        flex-grow: 1;
    }
    .box3 {
        border: 5px solid;
        border-color: #8585d2;
        border-radius: 20px;
        padding: 15px;
    }
    .box3 h1 {
        text-align: center;
    }
    .ketinggian_makanan {
        width: 40%;
    }

    .kekeruhan_air {
        font-size: 70px;
        font-weight: bold;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        color: #0085ff;
    }
</style>
<body>
    {{-- Tampilan website --}}
    <header>
        <h1>Sistem Cerdas Aquaponic Pada Lab Pemograman dan Komputasi FMIPA UNTAN</h1>
    </header>
    <div class="my-3" style="text-align: end; margin-right: 25px;">
        <h3 id="clock"></h3>
    </div>

    {{-- Tampilan nilai Sensor --}}
    <div class="container-fluid">
        <div class="row" style="text-align: center;">
            <div class="mb-3 col-md-7">
                <div class="card card-height">
                    <div class="card-header" style="background-color: #8585d2; color: white">
                        <h4>SISA MAKANAN</h4>
                    </div>
                    <div class="box2 me-3">
                        <div class="box3 ms-3 " style="margin: auto">
                            <h1 id="foodWasteValue" style="color: #0085ff; font-size: 70px">
                                <span id="sisa_makanan">0</span><span>%</span>
                            </h1>
                        </div>
                        <div class="ketinggian_makanan m-2">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card card-height">
                    <div class="card-header" style="background-color: #8585d2; color: white">
                        <h4>KEKERUHAN AIR</h4>
                    </div>
                    <div class="card-body">
                        <div class="kekeruhan_air">
                            <span id="kekeruhan">0</span> <span>NTU</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function updateClock() {
            var now = new Date();
            var days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            var dayOfWeek = days[now.getDay()];
            var date = now.getDate();
            var months = [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember",
            ];
            var month = months[now.getMonth()];
            var year = now.getFullYear();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();
            document.getElementById("clock").textContent =
                dayOfWeek +
                ", " +
                date +
                " " +
                month +
                " " +
                year +
                " - " +
                hours +
                ":" +
                (minutes < 10 ? "0" : "") +
                minutes +
                ":" +
                (seconds < 10 ? "0" : "") +
                seconds;
            setTimeout(updateClock, 1000);
        }

        let myChart;

        function initChart() {
            const ctx = document.getElementById("myChart").getContext("2d");
            myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["Sisa Makanan"],
                    datasets: [
                        {
                            label: "Sisa Makanan",
                            data: [0],
                            backgroundColor: ["rgba(255, 165, 0, 0.2)"],
                            borderColor: ["rgb(255, 159, 64)"],
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMin: 0,
                            suggestedMax: 100,
                        },
                    },
                    maintainAspectRatio: false,
                },
            });
        }

        function updateChart() {
            const foodWasteElement = document.getElementById("sisa_makanan");
            const foodWasteValue = parseInt(foodWasteElement.textContent, 10);

            myChart.data.datasets[0].data[0] = foodWasteValue;
            myChart.update();
        }

        function adjustCardHeight() {
            const cards = document.querySelectorAll('.card.card-height');
            if (window.innerHeight > 860) {
                cards.forEach(card => {
                    card.style.height = '680px';
                });
            } else {
                cards.forEach(card => {
                    card.style.height = '500px';
                });
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            updateClock();
            initChart();
            adjustCardHeight();
            window.addEventListener('resize', adjustCardHeight);
        });
    </script>
</body>
</html>
