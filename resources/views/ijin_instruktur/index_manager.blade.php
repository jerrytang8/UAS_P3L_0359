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
                            <h4 class="card-title">Data Ijin Instruktur</h4>
                            <a href="{{ url('/ijin_instruktur/tambah') }}" class="btn btn-primary light btn-md ml-auto">
                                <i class="fa fa-plus scale5 mr-3"></i>Tambah Ijin Instruktur
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display min-w850">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Tanggal</th>
                                            <th>Jam</th>
                                            <th>Kelas</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Instruktur</th>
                                            <th>Pengganti</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($data as $i)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $i->tgl }}</td>
                                                <td>{{ $i->slot }}</td>
                                                <td>{{ $i->kelas }}</td>
                                                <td>
                                                    <?php if ($i->status == 0) {
                                                        echo 'Pending';
                                                    } elseif ($i->status == 1) {
                                                        echo 'Disetujui';
                                                    } else {
                                                        echo 'Ditolak';
                                                    } ?>
                                                </td>
                                                <td>{{ $i->keterangan }}</td>
                                                <td>{{ $i->instruktur }}</td>
                                                <td>{{ $i->pengganti }}</td>
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
                                                            <form action="{{ url("deposit_kelas/$i->id") }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                    data-toggle="modal"
                                                                    data-target="#status{{ $i->id }}">Konfirmasi</a>
                                                                {{-- <button type="submit" class="dropdown-item"
                                                                    onclick="return confirm('Apakah Anda Yakin?')"><span
                                                                        data-feather="x-circle"></span>Hapus
                                                                </button> --}}
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="status{{ $i->id }}">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi Status</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('/ijin_instruktur/konfirmasi') }}"
                                                                method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $i->id }}">
                                                                <div class="form-group">
                                                                    <label>Status</label>
                                                                    <select class="form-control" name="status" required>
                                                                        <option value="1">Setujui</option>
                                                                        <option value="2">Tolak</option>
                                                                    </select>
                                                                </div>
                                                                <button class="btn btn-primary">Submit</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
