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
                            <h4 class="card-title">Data Presensi Kelas {{ $kelas }}</h4>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#tambah"
                                class="btn btn-primary light btn-md ml-auto">
                                <i class="fa fa-plus scale5 mr-3"></i>Absensi Member
                            </a>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="tambah">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Absensi Member</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('/presensi_kelas/save_absensi') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="jadwal_har" value="{{ $jadwal_har }}">
                                            <div class="form-group">
                                                <label>Member</label>
                                                <select class="form-control" name="member" required>
                                                    <option value="">--Pilih--</option>
                                                    @foreach ($member as $m)
                                                        <option value="{{ $m->memberid }}">
                                                            {{ $m->memberid }}/{{ $m->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <button class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display min-w850">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Tanggal</th>
                                            <th>Nama Member</th>
                                            <th>Jenis Presensi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($data as $i)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $i->tanggal }}</td>
                                                <td>{{ $i->nama_member }}</td>
                                                <td>{{ $i->keterangan }}</td>
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
                                                            <form action="{{ url('presensi_gym/id') }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                {{-- <a class="dropdown-item"
                                                                    href="{{ url("/presensi_kelas/$i->id/absen_member") }}"
                                                                    target="_blank">Presensi Kelas</a> --}}
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
