@extends('layouts.app')

@section('main')
    <div class="content-body">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-sm-flex d-block pb-0 border-0">
                    <div class="mr-auto pr-3 mb-sm-0 mb-3">
                        <h4 class="text-black fs-20">Pencarian Data</h4>
                        <p class="fs-13 mb-0 text-black">Untuk melakukan pencarian inputkan tahun kemudian tekan enter</p>
                        <br>
                    </div>
                    <div class="dropdown mb-3">
                        <input type="text" class="form-control" name="periode" id="periode" value="{{ $tahun }}">
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
                                    <h4 class="text-black fs-20">LAPORAN BULANAN</h4>
                                    <p class="fs-13 mb-0 text-black">Periode : {{ date('Y') }}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-0">
                                    {{-- <div class="mt-4 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div> <strong>Gofit</strong> </div>
                                    <div>Jl. Centralpark No. 10 Yigyakarta</div>
                                    <br><br>
                                    <div> <strong>LAPORAN BULANAN</strong> </div>
                                    <div>Periode : {{ date('Y') }}</div>
                                </div> --}}
                                    {{-- <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                    <h6>To:</h6>
                                    <div> <strong>Bob Mart</strong> </div>
                                    <div>Attn: Daniel Marek</div>
                                    <div>43-190 Mikolow, Poland</div>
                                    <div>Email: marek@daniel.com</div>
                                    <div>Phone: +48 123 456 789</div>
                                </div> --}}
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Bulan</th>
                                                <th>Aktivasi</th>
                                                <th>Deposit</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $d)
                                                <tr>
                                                    <td class="left">{{ $d['bulan'] }}</td>
                                                    <td class="text-right">{{ MyHelper::nf($d['aktivasi']) }}</td>
                                                    <td class="text-right">{{ MyHelper::nf($d['deposit']) }}</td>
                                                    <td class="text-right">{{ MyHelper::nf($d['total']) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="3" class="text-right">Total</td>
                                                <td class="text-right">{{ MyHelper::nf($total) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Laporan Pendapatan</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="barChart_1"></canvas>
                            </div>
                            <?php
                            foreach ($data as $d) {
                                $month[] = $d['bulan'];
                                $total_bln[] = $d['total'];
                            }
                            ?>
                            <script src="{{ asset('theme/vendor/chart.js/Chart.bundle.min.js') }}"></script>
                            <script>
                                var barChart_1 = document.getElementById("barChart_1").getContext('2d');

                                barChart_1.height = 100;

                                new Chart(barChart_1, {
                                    type: 'bar',
                                    data: {
                                        defaultFontFamily: 'Poppins',
                                        labels: <?php echo json_encode($month); ?>,
                                        datasets: [{
                                            label: "Pendapatan",
                                            data: <?php echo json_encode($total_bln); ?>,
                                            borderColor: 'rgba(11, 42, 151, 1)',
                                            borderWidth: "0",
                                            backgroundColor: 'rgba(11, 42, 151, 1)'
                                        }]
                                    },
                                    options: {
                                        legend: false,
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }],
                                            xAxes: [{
                                                // Change here
                                                barPercentage: 0.8
                                            }]
                                        }
                                    }
                                });
                            </script>
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
        $('#periode').on('change', function() {
            var periode = this.value;
            // alert(periode);
            $.ajax({
                url: "{{ url('/lap_pendapatan/update_lap') }}",
                type: 'POST',
                data: {
                    _methode: "POST",
                    // _token: {{ csrf_token() }},
                    periode: periode
                },
                success: function(data) {
                    // console.log(data);
                    $('#hasil').html(data);
                }
            });
        });
    </script>
@endsection
