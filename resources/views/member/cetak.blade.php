@extends('layouts.app')

@section('main')
    <div class="content-body">
        <div class="container-fluid">
            {{-- <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
            </ol>
        </div> --}}
            <!-- row -->


            <div class="row">
                <div class="col-12">
                    <div class="card" id="html-content-holder">
                        <div class="card-footer" id="card">
                            <h5 class="card-title">GoFit <br><small>Jl. Centralspanark No. 10 Yogyakarta</small></h5>
                            <br>
                            <h4 class="card-title">MEMBER CARD</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-sm-4">Member ID</div>
                                        <div class="col-sm-8 row">: {{ $data->memberid }}</div>
                                        <div class="col-sm-4">Nama</div>
                                        <div class="col-sm-8 row">: {{ $data->nama }}</div>
                                        <div class="col-sm-4">Alamat</div>
                                        <div class="col-sm-8 row">: {{ $data->alamat }}</div>
                                        <div class="col-sm-4">Telepon</div>
                                        <div class="col-sm-8 row">: {{ $data->no_telp }}</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="visible-print text-center">
                                        {!! QrCode::size(100)->generate($data->memberid) !!}
                                        {{-- <p>Scan me to return to the original page.</p> --}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <a id="btn-Preview-Image" type="button" class="btn btn-primary" onclick="printcard('card')">Cetak</a>
                    {{-- <a id="btn-Preview-Image" type="button" class="btn btn-primary">Cetak</a> --}}
                    <a href="{{ url('/member') }}" type="button" class="btn btn-danger">Batal</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('theme/js/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/js/html2canvas.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Global variable 
            var element = $("#html-content-holder");

            // Global variable 
            var getCanvas;

            $("#btn-Preview-Image").on('click', function() {
                html2canvas(element, {
                    onrendered: function(canvas) {
                        var myImage = canvas.toDataURL("image/png", 1);
                        var tWindow = window.open("");
                        $(tWindow.document.body)
                            .html("<img id='Image' src=" + myImage +
                                " style='width:100%;'></img>")
                            .ready(function() {
                                tWindow.focus();
                                tWindow.print();
                            });
                    }
                });
            });
        });


        function printcard(card) {
            var printContents = document.getElementById(card).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
