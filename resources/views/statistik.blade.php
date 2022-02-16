@extends('layouts.app1')
@section('title', 'Statistik')
@push('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/charts/apexcharts.css">
@endpush
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Statistik Perangkat </h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Statistik
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <p>Nama Device: {{$device->nama_device}}</p>
            </div>
        </div>
        <!-- apex charts section start -->
        <section id="apexchart">
            <div class="row">
                {{-- <!-- Line Chart -->
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Line Chart</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div id="line-chart"></div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                @if ($device->tipe_device == "pendeteksi_banjir")
                    
                    <!-- Line Area Chart -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Jarak Air</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div id="air"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif($device->tipe_device == "pendeteksi_angin")

                    <!-- Line Area Chart -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Kecepatan Angin</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div id="angin"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Suhu</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div id="suhu"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Kelembaban</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div id="kelembaban"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Intensitas Cahaya</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div id="intensitas_cahaya"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Hujan</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div id="hujan"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- // Apex charts section end -->

    </div>
@endsection
@push('js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <!-- END: Page Vendor JS-->
    
    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/charts/chart-apex.js"></script>
    <!-- END: Page JS-->

    @if ($device->tipe_device == "pendeteksi_banjir")
        <script>
            // var chartair = {!! json_encode($air) !!};
            // // var jarak_air = [];
            // var suhu = [];
            // var kelembaban = [];
            // var intensitas_cahaya = [];
            // var hujan = [];
            // var interval = [];

            // for (let i = 0; i < chartair.length; i++) {
            //     // const element = array[index];
            //     // jarak_air.push(chartair[i].jarak_air);
            //     suhu.push(chartair[i].suhu);
            //     kelembaban.push(chartair[i].kelembaban);
            //     intensitas_cahaya.push(chartair[i].intensitas_cahaya);
            //     hujan.push(chartair[i].hujan);
            //     interval.push(chartair[i].interval);
            // }
            // console.log(jarak_air);
            // console.log(interval);
            // console.log(suhu);

            var optionsAir = document.querySelector("#air");
            var chartAir = new ApexCharts(optionsAir, {
                chart: {
                    type: 'area'
                },
                colors: ['#1998cf'],
                stroke: {
                    curve: 'smooth'
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: 'Ketinggian Air',
                    data: []
                }],
                legend: {
                    show: true,
                    position: 'bottom'
                },
                fill: {
                    type: "gradient",
                    gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: [],
                    labels: {
                        show: false
                    }
                },
                yaxis:{
                    title: {
                        text: 'Centimeter (cm)'
                    }
                }
            });

            chartAir.render();

            var optionsSuhu = document.querySelector("#suhu");
            var chartSuhu = new ApexCharts(optionsSuhu, {
                chart: {
                    type: 'area'
                },
                colors: ['#ffcc00'],
                stroke: {
                    curve: 'smooth'
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: 'Suhu',
                    data: []
                }],
                fill: {
                    type: "gradient",
                    gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: [],
                    labels: {
                        show: false
                    }
                },
                yaxis:{
                    title: {
                        text: 'Celcius (°C)'
                    }
                }
            });

            chartSuhu.render();

            var optionsKelembaban = document.querySelector("#kelembaban");
            var chartKelembaban= new ApexCharts(optionsKelembaban, {
                chart: {
                    type: 'area'
                },
                colors: ['#59afda'],
                stroke: {
                    curve: 'smooth'
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: 'Kelembaban',
                    data: []
                }],
                fill: {
                    type: "gradient",
                    gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: [],
                    labels: {
                        show: false
                    }
                },
                yaxis:{
                    title: {
                        text: 'Relative Humidity (% RH)'
                    }
                }
            });

            chartKelembaban.render();

            var optionsIntensitasCahaya = document.querySelector("#intensitas_cahaya");
            var chartIntensitasCahaya= new ApexCharts(optionsIntensitasCahaya, {
                chart: {
                    type: 'area'
                },
                colors: ['#ebe838'],
                stroke: {
                    curve: 'smooth'
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: 'Intensitas Cahaya',
                    data: []
                }],
                fill: {
                    type: "gradient",
                    gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: [],
                    labels: {
                        show: false
                    }
                },
                yaxis:{
                    title: {
                        text: 'Lux (lx)'
                    }
                }
            });

            chartIntensitasCahaya.render();

            var optionsHujan = document.querySelector("#hujan");
            var chartHujan= new ApexCharts(optionsHujan, {
                chart: {
                    type: 'area'
                },
                colors: ['#9aafc5'],
                stroke: {
                    curve: 'smooth'
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: 'Hujan',
                    data: []
                }],
                fill: {
                    type: "gradient",
                    gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: [],
                    labels: {
                        show: false
                    }
                }
            });

            chartHujan.render();

            var updateChart = function() {
                var id = {!! json_encode($device->id) !!};
                $.ajax({
                    url: "/statistik/update/"+ id +"",
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // chartAir.xaxis.categories = [2,2];
                        // console.log(response.jarak_air);
                        chartAir.updateOptions({
                            series: [{
                                data: response.jarak_air
                            }],
                            xaxis: {
                                categories: response.interval_air
                            } 
                        });

                        chartSuhu.updateOptions({
                            series: [{
                                data: response.suhu_air
                            }],
                            xaxis: {
                                categories: response.interval_air
                            } 
                        });

                        chartKelembaban.updateOptions({
                            series: [{
                                data: response.kelembaban_air
                            }],
                            xaxis: {
                                categories: response.interval_air
                            } 
                        });

                        chartIntensitasCahaya.updateOptions({
                            series: [{
                                data: response.cahaya_air
                            }],
                            xaxis: {
                                categories: response.interval_air
                            } 
                        });

                        chartHujan.updateOptions({
                            series: [{
                                data: response.hujan_air
                            }],
                            xaxis: {
                                categories: response.interval_air
                            } 
                        });
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            }

            updateChart();
            setInterval(() => {
                updateChart();
            }, 3000);

            // var optionsHujan = {
            //     chart: {
            //         type: 'area'
            //     },
            //     colors: ['#1998cf'],
            //     stroke: {
            //         curve: 'smooth'
            //     },
            //     dataLabels: {
            //         enabled: false
            //     },
            //     series: [{
            //         name: 'Intensitas Hujan',
            //         data: hujan
            //     }],
            //     fill: {
            //         type: "gradient",
            //         gradient: {
            //         shadeIntensity: 1,
            //         opacityFrom: 0.7,
            //         opacityTo: 0.9,
            //         stops: [0, 90, 100]
            //         }
            //     },
            //     xaxis: {
            //         categories: interval
            //     }
            // }

            // var chartHujan = new ApexCharts(document.querySelector("#hujan"),optionsHujan);

            // chartHujan.render();

        </script>

    @elseif($device->tipe_device == "pendeteksi_angin")
        <script>
            var optionsAngin = document.querySelector("#angin");
            var chartAngin = new ApexCharts(optionsAngin, {
                chart: {
                    type: 'area'
                },
                colors: ['#1998cf'],
                stroke: {
                    curve: 'smooth'
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: 'Kecepatan Angin',
                    data: []
                }],
                legend: {
                    show: true,
                    position: 'bottom'
                },
                fill: {
                    type: "gradient",
                    gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: [],
                    labels: {
                        show: false,
                    }
                },
                yaxis:{
                    title: {
                        text: 'meter per detik (m/s)'
                    }
                }
            });

            chartAngin.render();

            var optionsSuhu = document.querySelector("#suhu");
            var chartSuhu = new ApexCharts(optionsSuhu, {
                chart: {
                    type: 'area'
                },
                colors: ['#ffcc00'],
                stroke: {
                    curve: 'smooth'
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: 'Suhu',
                    data: []
                }],
                fill: {
                    type: "gradient",
                    gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: [],
                    labels: {
                        show: false
                    }
                },
                yaxis:{
                    title: {
                        text: 'Celcius (°C)'
                    }
                }
            });

            chartSuhu.render();

            var optionsKelembaban = document.querySelector("#kelembaban");
            var chartKelembaban= new ApexCharts(optionsKelembaban, {
                chart: {
                    type: 'area'
                },
                colors: ['#59afda'],
                stroke: {
                    curve: 'smooth'
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: 'Kelembaban',
                    data: []
                }],
                fill: {
                    type: "gradient",
                    gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: [],
                    labels: {
                        show: false
                    }
                },
                yaxis:{
                    title: {
                        text: 'Relative Humidity (% RH)'
                    }
                }
            });

            chartKelembaban.render();

            var optionsIntensitasCahaya = document.querySelector("#intensitas_cahaya");
            var chartIntensitasCahaya= new ApexCharts(optionsIntensitasCahaya, {
                chart: {
                    type: 'area'
                },
                colors: ['#ebe838'],
                stroke: {
                    curve: 'smooth'
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: 'Intensitas Cahaya',
                    data: []
                }],
                fill: {
                    type: "gradient",
                    gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: [],
                    labels: {
                        show: false
                    }
                },
                yaxis:{
                    title: {
                        text: 'Lux (lx)'
                    }
                }
            });

            chartIntensitasCahaya.render();

            var optionsHujan = document.querySelector("#hujan");
            var chartHujan= new ApexCharts(optionsHujan, {
                chart: {
                    type: 'area'
                },
                colors: ['#9aafc5'],
                stroke: {
                    curve: 'smooth'
                },
                dataLabels: {
                    enabled: false
                },
                series: [{
                    name: 'Hujan',
                    data: []
                }],
                fill: {
                    type: "gradient",
                    gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    categories: [],
                    labels: {
                        show: false
                    }
                }
            });

            chartHujan.render();

            var updateChart = function() {
                var id = {!! json_encode($device->id) !!};
                $.ajax({
                    url: "/statistik/update/"+ id +"",
                    type: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        chartAngin.updateOptions({
                            series: [{
                                data: response.kecepatan_angin
                            }],
                            xaxis: {
                                categories: response.interval_angin
                            } 
                        });

                        chartSuhu.updateOptions({
                            series: [{
                                data: response.suhu_angin
                            }],
                            xaxis: {
                                categories: response.interval_angin
                            } 
                        });

                        chartKelembaban.updateOptions({
                            series: [{
                                data: response.kelembaban_angin
                            }],
                            xaxis: {
                                categories: response.interval_angin
                            } 
                        });

                        chartIntensitasCahaya.updateOptions({
                            series: [{
                                data: response.cahaya_angin
                            }],
                            xaxis: {
                                categories: response.interval_angin
                            } 
                        });

                        chartHujan.updateOptions({
                            series: [{
                                data: response.hujan_angin
                            }],
                            xaxis: {
                                categories: response.interval_angin
                            } 
                        });
                    },
                    error: function(response){
                        console.log(response);
                    }
                });
            }

            updateChart();
            setInterval(() => {
                updateChart();
            }, 3000);

            // var optionsHujan = {
            //     chart: {
            //         type: 'area'
            //     },
            //     colors: ['#1998cf'],
            //     stroke: {
            //         curve: 'smooth'
            //     },
            //     dataLabels: {
            //         enabled: false
            //     },
            //     series: [{
            //         name: 'Intensitas Hujan',
            //         data: hujan
            //     }],
            //     fill: {
            //         type: "gradient",
            //         gradient: {
            //         shadeIntensity: 1,
            //         opacityFrom: 0.7,
            //         opacityTo: 0.9,
            //         stops: [0, 90, 100]
            //         }
            //     },
            //     xaxis: {
            //         categories: interval
            //     }
            // }

            // var chartHujan = new ApexCharts(document.querySelector("#hujan"),optionsHujan);

            // chartHujan.render();

            // setInterval(() =>{
            //     chartangin;
            // }, 1000);

        </script>
    @endif

    
@endpush