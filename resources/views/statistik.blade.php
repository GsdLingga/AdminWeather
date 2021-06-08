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

                {{-- <div class="col-lg-6 col-md-12">
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
                </div> --}}

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
            var id = {!! json_encode($device->id) !!};
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
                    categories: []
                }
            });

            chartAir.render();

            var optionsSuhu = document.querySelector("#suhu");
            var chartSuhu = new ApexCharts(optionsSuhu, {
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
                    categories: []
                }
            });

            chartSuhu.render();

            var optionsKelembaban = document.querySelector("#kelembaban");
            var chartKelembaban= new ApexCharts(optionsKelembaban, {
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
                    categories: []
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
                    categories: []
                }
            });

            chartIntensitasCahaya.render();

            var updateChart = function() {
                $.ajax({
                    url: "/statistik/update/1",
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
            var chartangin = {!! json_encode($angin) !!};
            var kecepatan_angin = [];
            var suhu = [];
            var kelembaban = [];
            var intensitas_cahaya = [];
            var hujan = [];
            var interval = [];

            for (let i = 0; i < chartangin.length; i++) {
                // const element = array[index];
                kecepatan_angin.push(chartangin[i].kecepatan_angin);
                suhu.push(chartangin[i].suhu);
                kelembaban.push(chartangin[i].kelembaban);
                intensitas_cahaya.push(chartangin[i].intensitas_cahaya);
                hujan.push(chartangin[i].hujan);
                interval.push(chartangin[i].interval);
            }
            // console.log(jarak_air);
            // console.log(interval);
            // console.log(suhu);

            var optionsAngin = {
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
                    data: kecepatan_angin
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
                    categories: interval
                }
            }

            var chartAngin = new ApexCharts(document.querySelector("#angin"),optionsAngin);

            chartAngin.render();

            var optionsSuhu = {
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
                    name: 'Suhu',
                    data: suhu
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
                    categories: interval
                }
            }

            var chartSuhu = new ApexCharts(document.querySelector("#suhu"),optionsSuhu);

            chartSuhu.render();

            var optionsKelembaban = {
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
                    name: 'Kelembaban',
                    data: kelembaban
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
                    categories: interval
                }
            }

            var chartKelembaban = new ApexCharts(document.querySelector("#kelembaban"),optionsKelembaban);

            chartKelembaban.render();

            var optionsIntensitasCahaya = {
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
                    name: 'Intensitas Cahaya',
                    data: intensitas_cahaya
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
                    categories: interval
                }
            }

            var chartIntensitasCahaya = new ApexCharts(document.querySelector("#intensitas_cahaya"),optionsIntensitasCahaya);

            chartIntensitasCahaya.render();

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