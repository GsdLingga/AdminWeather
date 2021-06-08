@extends('layouts.app1')

@section('title', 'Home')

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
@endpush
    
@section('content')
    <div class="content-header row">
    </div>
    <div class="content-body">
        <!-- Dashboard Analytics Start -->
        <section id="dashboard-analytics">
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">{{ $total_device }}</h2>
                                <p>Total Perangkat</p>
                            </div>
                            <div class="avatar bg-rgba-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-cpu text-primary font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">{{ $total_air }}</h2>
                                <p>Pendeteksi Banjir</p>
                            </div>
                            <div class="avatar bg-rgba-success p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-droplet text-success font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">{{ $total_angin }}</h2>
                                <p>Pendeteksi Badai Angin</p>
                            </div>
                            <div class="avatar bg-rgba-danger p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-wind text-danger font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Basic Map -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Peta Lokasi Perangkat</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div id="mapid" class="height-400"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Dashboard Analytics end -->

    </div>
@endsection

@push('js')
    <script>
        var mymap = L.map('mapid').setView([-8.4575749,115.0914673], 9);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZ3VzZGVrIiwiYSI6ImNraDV1eGY2YzA0ZzkyeGs5YjMyMW84aHkifQ.pA67BruOX1Hap0VTTByt4w'
        }).addTo(mymap);

        // for (i = 0; i < $total_perangkat; i++) {
        //     // const element = array[index];
        //     var marker = L.marker([$lokasi_perangkat[i][2], $lokasi_perangkat[i][3]]).addTo(mymap);
 
        // }

        var total_marker = {!! json_encode($total_device) !!};
        var perangkat = {!! json_encode($lokasi_perangkat) !!};
        
        // console.log(total_marker);

        for (let i = 0; i < total_marker; i++) {
            // const element = array[i];
            // console.log(i);
            var marker = L.marker([perangkat[i].latitude,perangkat[i].longitude]).addTo(mymap)
            .bindPopup(
                "<table>" +
                    "<tbody>" +
                        "<tr>" +
                            "<td>" + "Nama Device" + ":" + perangkat[i].nama_device + "</td>" +
                        "</tr>" +
                        "<tr>" +
                            "<td>" + "Tipe Device" + ":" + perangkat[i].tipe_device + "</td>" +
                        "</tr>" +
                        "<tr>" +
                            "<td>" + '<a href="statistik/' + perangkat[i].id_device + '" class="btn btn-info">' + 'Statistik' + '</a>' + "</td>" +
                        "</tr>" +
                    "</tbody>" +
                "</table>"
            );   
        }

        

        // marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();

        // var popup = L.popup()
        // .setLatLng([51.5, -0.09])
        // .setContent("I am a standalone popup.")
        // .openOn(mymap);
    </script>
    
@endpush