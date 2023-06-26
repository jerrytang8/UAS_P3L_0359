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
                    @if (session()->has('berhasil'))
                        <div class="alert alert-success solid alert-dismissible fade show">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                            <strong>Berhasil!</strong> {{ session('berhasil') }}
                            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                                        class="mdi mdi-close"></i></span>
                            </button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header d-sm-flex d-block pb-0 border-0">
                            <h4 class="card-title">Data Presensi Kelas</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display min-w850">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>No Struk</th>
                                            <th>Tanggal</th>
                                            <th>Member</th>
                                            <th>Jenis Presensi</th>
                                            <th>Kelas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($data as $i)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $i->no_struk }}</td>
                                                <td>{{ $i->tanggal }}</td>
                                                <td>{{ $i->member }}/{{ $i->nama_member }}</td>
                                                <td>{{ $i->keterangan }}</td>
                                                <td>{{ $i->kelas }}</td>
                                                <td>
                                                    <div class="dropdown ml-auto text-right">
                                                        <div class="btn-link" data-toggle="dropdown">
                                                            <svg width="24px" height="24px" viewBox="0 0 24 24"
                                                                version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                    fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24"
                                                                        height="24"></rect>
                                                                    <circle fill="#000000" cx="5" cy="12"
                                                                        r="2"></circle>
                                                                    <circle fill="#000000" cx="12" cy="12"
                                                                        r="2"></circle>
                                                                    <circle fill="#000000" cx="19" cy="12"
                                                                        r="2"></circle>
                                                                </g>
                                                            </svg>
                                                        </div>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <form action="{{ url('presensi_kelas/id') }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <?php if($i->jenis_transaksi=='05') { ?>
                                                                <a class="dropdown-item"
                                                                    href="{{ url("/presensi_kelas/$i->id/cetak") }}"
                                                                    target="_blank">Cetak Struk</a>
                                                                <?php } ?>
                                                                <?php if($i->jenis_transaksi=='06') { ?>
                                                                <a class="dropdown-item"
                                                                    href="{{ url("/presensi_kelas/$i->id/cetak_paket") }}"
                                                                    target="_blank">Cetak Struk</a>
                                                                <?php } ?>
                                                                {{-- <button type="submit" class="dropdown-item"
                                                                    onclick="return confirm('Apakah Anda Yakin?')"><span
                                                                        data-feather="x-circle"></span>Hapus</button> --}}
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="row">
                    <div id="reader" width="600px"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
