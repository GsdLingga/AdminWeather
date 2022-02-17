@extends('layouts.app1')
@section('title', 'Perangkat')
@push('css')
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <!-- END: Vendor CSS-->
    <style>
        .modal-open {
          padding-right: 0px;
        }
        .modal-busy {
            position: fixed;
            z-index: 999;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            background-color: Black;
            filter: alpha(opacity=60);
            opacity: 0.6;
            -moz-opacity: 0.8;
        }
        .center-busy {
            z-index: 1000;
            margin: 300px auto;
            padding: 0px;
            width: 130px;
            filter: alpha(opacity=100);
            opacity: 1;
            -moz-opacity: 1;
        }
        .center-busy img {
            height: 128px;
            width: 128px;
        }
      </style>
@endpush

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Perangkat</h2>
                    {{-- <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Datatable
                            </li>
                        </ol>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12">
            <div class="form-group breadcrum-right">
                <a href="javascript:void(0)" class="btn btn-outline-primary" id="create-new-device" onclick="addDevice()"><i class="feather icon-plus"></i> Tambah Perangkat</a>
                {{-- <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Zero configuration table -->
        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Perangkat</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table zero-configuration">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Id Perangkat</th>
                                                <th>Nama Perangkat</th>
                                                <th>Tipe Perangkat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < count($device); $i++)
                                            <tr id="row_{{$device[$i]->id}}">
                                                <td>{{ $i+1}}</td>
                                                <td>{{ $device[$i]->id}}</td>
                                                <td>{{ $device[$i]->nama_device}}</td>
                                                <td>@if ($device[$i]->tipe_device == "pendeteksi_banjir")
                                                        Pendeteksi Banjir
                                                    @elseif ($device[$i]->tipe_device == "pendeteksi_angin")
                                                        Pendeteksi Angin 
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" data-id="{{ $device[$i]->id }}" onclick="editDevice(event.target)" class="btn btn-info">Edit</a>
                                                    <a href="javascript:void(0)" data-id="{{ $device[$i]->id }}" class="btn btn-danger" onclick="deleteDevice(event.target)">Delete</a>
                                                </td>
                                            </tr>
                                            @endfor
                                        </tbody>
                                        <tfoot>
                                            {{-- <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr> --}}
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="modal-busy" id="loader" style="display: none">
                                    <div class="center-busy" id="test-git">
                                        <img alt="" src="{{ asset('app-assets') }}/images/loading.svg" />
                                    </div>
                                </div>
                                <div class="modal fade" id="post-modal" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                          <h3 class="modal-title"></h3>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <form name="deviceForm" class="form-horizontal">
                                                <input type="hidden" name="device_id" id="device_id">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="nama_device" name="nama_device" class="form-control" placeholder="Nama Perangkat" value="" required>
                                                            <label for="name-floating">Nama Device</label>
                                                            <span id="namaDeviceError" class="alert-message"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="name-floating">Tipe Device</label>
                                                            <select class="select2 form-control" id="tipe_device" name="tipe_device">
                                                                <option value="">Tipe Device</option>
                                                                <option value="pendeteksi_banjir">Pendeteksi Banjir</option>
                                                                <option value="pendeteksi_angin">Pendeteksi Angin</option>
                                                            </select>
                                                            <span id="tipeDeviceError" class="alert-message"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                {{-- <div class="form-group">
                                                    <label for="name" class="col-sm-8">Nama Device</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="nama_device" name="nama_device" placeholder="Masukkan Nama Perangkat" value="" required>
                                                        <span id="namaDeviceError" class="alert-message"></span>
                                                    </div>
                                                </div> --}}
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" onclick="createDevice()">Confirm</button>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Delete Confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <p>Are You Sure Want to Delete?.</p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-danger" id="btnDelete">Yes</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Zero configuration table -->
    </div>
@endsection

@push('js')

    <script>
        $("#post-modal").on('hidden.bs.modal', function(e) {
        $("#device_id").val('');
        $("#nama_device").val('');
        $("#tipe_device").val('');
        })
    </script>
        
    <script>
        function addDevice() {
            $("#device_id").val();
            $('#post-modal').modal('show');
        }
        
        function editDevice(event) {
            var id  = $(event).data("id");
            let _url = `/perangkat/${id}`;
            $('#namaDeviceError').text('');
            $("#loader").show();
            
            $.ajax({
            url: _url,
            type: "GET",
            success: function(response) {
                if(response) {
                    $("#device_id").val(response.id);
                    $("#nama_device").val(response.nama_device);
                    $("#tipe_device").val(response.tipe_device);
                    $('#post-modal').modal('show');
                    $("#loader").hide();
                }
            }
            });
        }
        
        function createDevice() {
            var nama_device = $('#nama_device').val();
            var tipe_device = $('#tipe_device').val();
            var id = $('#device_id').val();
        
            let _url     = `/perangkat`;
            let _token   = $('meta[name="csrf-token"]').attr('content');
        
            if(nama_device!="" && tipe_device!=""){
                $('#post-modal').modal('hide');

                $("#loader").show();
            
                $.ajax({
                    url: _url,
                    type: "POST",
                    data: {
                    device_id: id,
                    nama_device: nama_device,
                    tipe_device: tipe_device,
                    _token: _token
                    },

                    success: function(response) {
                        if(response.code == 200) {

                        if(id != ""){
                            $("#row_"+id+" td:nth-child(2)").html(response.data.id);
                            $("#row_"+id+" td:nth-child(3)").html(response.data.nama_device);
                            $("#row_"+id+" td:nth-child(4)").html(response.data.tipe_device);

                            // location.reload(true);
                        } else {
                            // $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editAccount(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');
                            // $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');

                            // $('table tfoot').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.name+'</td><td>'+response.data.email+'</td><td>'+response.data.is_admin+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editAccount(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteAccount(event.target)">Delete</a></td></tr>');
                            $('table tfoot').prepend('<tr id="row_'+response.data.id+'"><td></td><td>'+response.data.id+'</td><td>'+response.data.nama_device+'</td><td>'+response.data.tipe_device+'</td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editDevice(event.target)" class="btn btn-info">Edit</a><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deleteDevice(event.target)">Delete</a></td></tr>');
                        }
                        $('#nama_device').val('');
                        $('#tipe_device').val('');
            
                        $('#post-modal').modal('hide');

                        // location.reload(true);

                        $("#loader").hide();
                        }

                    },
                    error: function(response) {
                    // $('#namaDeviceError').text(response.responseJSON.errors.nama_device);
                    console.log(JSON.stringify(response.responseJSON.errors));
                    }
                });
            }else{
            alert('Please fill all the field')
            }
        }
        
        function deleteDevice(event) {
            $('#delete-modal').modal('show');
            var id  = $(event).data("id");
            let _url = `/perangkat/${id}`;
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $(document).on('click', '#btnDelete', function(){
            $.ajax({
                url: _url,
                type: 'PUT',
                data: {
                _token: _token
                },
                beforeSend: function(){
                $("#loader").show();
                $('#delete-modal').modal('hide');
                },
                success: function(response) {
                $("#row_"+id).remove();
                $("#loader").hide();
                console.log(response.data);
                }
            });
            });
        }
    </script>
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('app-assets/js/scripts/datatables/datatable.js')}}"></script>
    <!-- END: Page JS-->
@endpush
