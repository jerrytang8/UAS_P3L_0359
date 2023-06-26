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
                <div class="col-xl-12 col-lg-12">
                    <div class="card" id="aksi">
                        <div class="card-header">
                            <h4 class="card-title">Scan Member Card</h4>
                        </div>
                        <div class="card-body">
                            <div id="reader" width="600px"></div>
                        </div>
                        <input type="hidden" name="result" id="result">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('theme/vendor/html5-qrcode/html5-qrcode.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        function onScanSuccess(decodedText, decodedResult) {
            $('#result').val(decodedText);
            var id = decodedText;
            // html5QrcodeScanner.clear().then(_ => {
            // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ url('/presensi_gym/cek_member') }}",
                type: 'POST',
                data: {
                    _methode: "POST",
                    // _token: {{ csrf_token() }},
                    qr_code: id
                },
                success: function(data) {
                    // alert(data);
                    // console.log(data);
                    location.href = data;
                    // $('#aksi').html(data);
                }
            });
            // });
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            //   console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 300,
                    height: 300
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection
