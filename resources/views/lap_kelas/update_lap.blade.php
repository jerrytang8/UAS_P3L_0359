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
                    <h4 class="text-black fs-20">LAPORAN AKTIVITAS KELAS BULANAN</h4>
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
                                <th>Kelas</th>
                                <th class="text-center">Instruktur</th>
                                <th class="text-center">Jumlah Peserta</th>
                                <th class="text-center">Jumlah Libur</th>
                            </tr>
                        </thead>
                        <?php if(!empty($data)) { ?>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td class="left">{{ $d['kelas'] }}</td>
                                    <td class="text-center">{{ $d['instruktur'] }}</td>
                                    <td class="text-center">{{ $d['peserta'] }}</td>
                                    <td class="text-center">{{ $d['libur'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
