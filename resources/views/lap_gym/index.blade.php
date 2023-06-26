@extends('layouts.app')

@section('main')
    <div class="content-body">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-sm-flex d-block pb-0 border-0">
                    <div class="row">
                        <div class="col-md-6 mr-auto pr-3 mb-sm-0 mb-3">
                            <h4 class="text-black fs-20">Pencarian Data</h4>
                            <p class="fs-13 mb-0 text-black">Untuk melakukan pencarian pilih bulan, inputkan tahun kemudian
                                tekan tombol cari</p>
                            <br>
                        </div>
                        <div class="col-md-6 dropdown mb-3 mt-4">
                            <div class="input-group">
                                <div class="dropdown bootstrap-select default-select">
                                    <select class="default-select" tabindex="-98" name="bulan" id="bulan">
                                        <option value="">--Pilih Bulan--</option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <input type="text" class="form-control" name="periode" id="periode">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" id="cari" type="button">Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="hasil">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header d-sm-flex d-block pb-0 border-0">
                                <div class="mr-auto pr-3 mb-sm-0 mb-3">
                                    <h4 class="text-black fs-20">Gofit</h4>
                                    <p class="fs-13 mb-0 text-black">Jl. Centralpark No. 10 Yogyakarta</p>

                                </div>

                            </div>
                            <div class="card-header">
                                <div class="mr-auto pr-3 mb-sm-0 mb-3">
                                    <h4 class="text-black fs-20">LAPORAN BULANAN AKTIVITAS GYM Bulanan</h4>
                                    <p class="fs-13 mb-0 text-black">Bulan: {{ MyHelper::bulan_tahun(date('Y-m')) }}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-0">

                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th class="text-center">Jumlah Member</th>
                                            </tr>
                                        </thead>
                                        <?php if(!empty($data)) { ?>
                                        <tbody>
                                            @foreach ($data as $d)
                                                <tr>
                                                    <td class="left">{{ MyHelper::tgl_bulan($d['tgl']) }}</td>
                                                    <td class="text-center">{{ $d['jml_member'] }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="text-left"><strong>Total</strong></td>
                                                <td class="text-center">{{ $total }}</td>
                                            </tr>
                                        </tbody>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        $('#cari').on('click', function() {
            var periode = $('#periode').val();
            var bulan = $('#bulan').val();
            // alert(periode);
            $.ajax({
                url: "{{ url('/lap_gym/update_lap') }}",
                type: 'POST',
                data: {
                    _methode: "POST",
                    // _token: {{ csrf_token() }},
                    periode: periode,
                    bulan: bulan
                },
                success: function(data) {
                    // alert(bulan);
                    // console.log(data);
                    $('#hasil').html(data);
                }
            });
        });
    </script>
@endsection
