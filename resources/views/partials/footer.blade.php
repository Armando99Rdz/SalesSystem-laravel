<footer class="footer footer-transparent">
    <div class="container">
        <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ml-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item"><a href="https://github.com/Armando99Rdz" target="_blank" class="link-secondary">GitHub</a></li>
                    <li class="list-inline-item"><a href="#" target="_blank" class="link-secondary">Linkedin</a></li>
                </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                Copyright © 2020
                <a href="." class="link-secondary">Armando Rdz</a>.
                All rights reserved.
            </div>
        </div>
    </div>
</footer>
</div>

<!-- Libs JS -->
<script src="{{asset('dist/libs/jquery/dist/jquery.slim.min.js')}}"></script>
<script src="{{asset('dist/libs/peity/jquery.peity.min.js')}}"></script>
<script src="{{asset('dist/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{asset('dist/libs/popper/popper.js')}}"></script>
<script src="{{asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('dist/libs/tail-select/tail.select-full.min.js')}}"></script>
{{--<script src="{{asset('dist/js/bootstrap-select.min.js')}}"></script>--}}
<!-- Tabler Core -->
<script src="{{asset('dist/js/tabler.min.js')}}"></script>

<!-- chartjs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

@stack('scripts')

<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
        //alert(document.getElementById('articulosselect').value);
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-revenue-bg'), {
            chart: {
                type: "area",
                fontFamily: 'inherit',
                height: 40.0,
                sparkline: {
                    enabled: true
                },
                animations: {
                    enabled: false
                },
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: .16,
                type: 'solid'
            },
            stroke: {
                width: 2,
                lineCap: "round",
                curve: "smooth",
            },
            series: [{
                name: "Profits",
                data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67]
            }],
            grid: {
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0
                },
                tooltip: {
                    enabled: false
                },
                axisBorder: {
                    show: false,
                },
                type: 'datetime',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels: [
                '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
            ],
            colors: ["#206bc4"],
            legend: {
                show: false,
            },
        })).render();
    });
    // @formatter:on
</script>
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-new-clients'), {
            chart: {
                type: "line",
                fontFamily: 'inherit',
                height: 40.0,
                sparkline: {
                    enabled: true
                },
                animations: {
                    enabled: false
                },
            },
            fill: {
                opacity: 1,
            },
            stroke: {
                width: [2, 1],
                dashArray: [0, 3],
                lineCap: "round",
                curve: "smooth",
            },
            series: [{
                name: "May",
                data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 4, 46, 39, 62, 51, 35, 41, 67]
            },{
                name: "April",
                data: [93, 54, 51, 24, 35, 35, 31, 67, 19, 43, 28, 36, 62, 61, 27, 39, 35, 41, 27, 35, 51, 46, 62, 37, 44, 53, 41, 65, 39, 37]
            }],
            grid: {
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0
                },
                tooltip: {
                    enabled: false
                },
                type: 'datetime',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels: [
                '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
            ],
            colors: ["#206bc4", "#a8aeb7"],
            legend: {
                show: false,
            },
        })).render();
    });
    // @formatter:on
</script>
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-active-users'), {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 40.0,
                sparkline: {
                    enabled: true
                },
                animations: {
                    enabled: false
                },
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%',
                }
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: "Profits",
                data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67]
            }],
            grid: {
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0
                },
                tooltip: {
                    enabled: false
                },
                axisBorder: {
                    show: false,
                },
                type: 'datetime',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels: [
                '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
            ],
            colors: ["#206bc4"],
            legend: {
                show: false,
            },
        })).render();
    });
    // @formatter:on
</script>
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-mentions'), {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 240,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
                stacked: true,
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%',
                }
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: "Web",
                data: [1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 2, 12, 5, 8, 22, 6, 8, 6, 4, 1, 8, 24, 29, 51, 40, 47, 23, 26, 50, 26, 41, 22, 46, 47, 81, 46, 6]
            },{
                name: "Social",
                data: [2, 5, 4, 3, 3, 1, 4, 7, 5, 1, 2, 5, 3, 2, 6, 7, 7, 1, 5, 5, 2, 12, 4, 6, 18, 3, 5, 2, 13, 15, 20, 47, 18, 15, 11, 10, 0]
            },{
                name: "Other",
                data: [2, 9, 1, 7, 8, 3, 6, 5, 5, 4, 6, 4, 1, 9, 3, 6, 7, 5, 2, 8, 4, 9, 1, 2, 6, 7, 5, 1, 8, 3, 2, 3, 4, 9, 7, 1, 6]
            }],
            grid: {
                padding: {
                    top: -20,
                    right: 0,
                    left: -4,
                    bottom: -4
                },
                strokeDashArray: 4,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
            },
            xaxis: {
                labels: {
                    padding: 0
                },
                tooltip: {
                    enabled: false
                },
                axisBorder: {
                    show: false,
                },
                type: 'datetime',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels: [
                '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19', '2020-07-20', '2020-07-21', '2020-07-22', '2020-07-23', '2020-07-24', '2020-07-25', '2020-07-26'
            ],
            colors: ["#206bc4", "#79a6dc", "#bfe399"],
            legend: {
                show: true,
                position: 'bottom',
                height: 32,
                offsetY: 8,
                markers: {
                    width: 8,
                    height: 8,
                    radius: 100,
                },
                itemMargin: {
                    horizontal: 8,
                },
            },
        })).render();
    });
    // @formatter:on
</script>
<script>
    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-development-activity'), {
            chart: {
                type: "area",
                fontFamily: 'inherit',
                height: 160,
                sparkline: {
                    enabled: true
                },
                animations: {
                    enabled: false
                },
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                opacity: .16,
                type: 'solid'
            },
            title: {
                text: "Development Activity",
                margin: 0,
                floating: true,
                offsetX: 10,
                style: {
                    fontSize: '18px',
                },
            },
            stroke: {
                width: 2,
                lineCap: "round",
                curve: "smooth",
            },
            series: [{
                name: "Purchases",
                data: [3, 5, 4, 6, 7, 5, 6, 8, 24, 7, 12, 5, 6, 3, 8, 4, 14, 30, 17, 19, 15, 14, 25, 32, 40, 55, 60, 48, 52, 70]
            }],
            grid: {
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0
                },
                tooltip: {
                    enabled: false
                },
                axisBorder: {
                    show: false,
                },
                type: 'datetime',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels: [
                '2020-06-20', '2020-06-21', '2020-06-22', '2020-06-23', '2020-06-24', '2020-06-25', '2020-06-26', '2020-06-27', '2020-06-28', '2020-06-29', '2020-06-30', '2020-07-01', '2020-07-02', '2020-07-03', '2020-07-04', '2020-07-05', '2020-07-06', '2020-07-07', '2020-07-08', '2020-07-09', '2020-07-10', '2020-07-11', '2020-07-12', '2020-07-13', '2020-07-14', '2020-07-15', '2020-07-16', '2020-07-17', '2020-07-18', '2020-07-19'
            ],
            colors: ["#206bc4"],
            legend: {
                show: false,
            },
            point: {
                show: false
            },
        })).render();
    });
    // @formatter:on
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $().peity && $('#sparkline-7').text("56/100").peity("pie", {
            width: 40,
            height: 40,
            stroke: "#cd201f",
            strokeWidth: 2,
            fill: ["#cd201f", "rgba(110, 117, 130, 0.2)"],
            padding: .2,
            innerRadius: 17,
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $().peity && $('#sparkline-8').text("22/100").peity("pie", {
            width: 40,
            height: 40,
            stroke: "#fab005",
            strokeWidth: 2,
            fill: ["#fab005", "rgba(110, 117, 130, 0.2)"],
            padding: .2,
            innerRadius: 17,
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $().peity && $('#sparkline-9').text("17, 24, 20, 10, 5, 1, 4, 18, 13").peity("line", {
            width: 64,
            height: 40,
            stroke: "#206bc4",
            strokeWidth: 2,
            fill: ["#d2e1f3"],
            padding: .2,
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $().peity && $('#sparkline-10').text("13, 11, 19, 22, 12, 7, 14, 3, 21").peity("line", {
            width: 64,
            height: 40,
            stroke: "#206bc4",
            strokeWidth: 2,
            fill: ["#d2e1f3"],
            padding: .2,
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $().peity && $('#sparkline-11').text("10, 13, 10, 4, 17, 3, 23, 22, 19").peity("line", {
            width: 64,
            height: 40,
            stroke: "#206bc4",
            strokeWidth: 2,
            fill: ["#d2e1f3"],
            padding: .2,
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $().peity && $('#sparkline-12').text("9, 6, 14, 11, 8, 24, 2, 16, 15").peity("line", {
            width: 64,
            height: 40,
            stroke: "#206bc4",
            strokeWidth: 2,
            fill: ["#d2e1f3"],
            padding: .2,
        });
    });
</script>
<script>
    document.body.style.display = "block"
</script>
</body>
</html>
