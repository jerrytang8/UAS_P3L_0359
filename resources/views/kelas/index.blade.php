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
                    <div class="card">
                        <div class="card-header d-sm-flex d-block pb-0 border-0">
                            <h4 class="card-title">Data Kelas</h4>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#tambah"
                                class="btn btn-primary light btn-md ml-auto">
                                <i class="fa fa-plus scale5 mr-3"></i>Tambah Kelas
                            </a>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="tambah">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Kelas</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('/kelas/tambah') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" name="nama" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga</label>
                                                <input type="number" name="harga" class="form-control" required>
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
                                            <th width="5%">ID</th>
                                            <th>Name</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($data as $i)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $i->nama }}</td>
                                                <td>{{ $i->harga }}</td>
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
                                                            <form action="{{ url("kelas/$i->id") }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a class="dropdown-item" href="" data-toggle="modal"
                                                                    data-target="#edit{{ $i->id }}">Edit</a>
                                                                <button type="submit" class="dropdown-item"
                                                                    onclick="return confirm('Apakah Anda Yakin?')"><span
                                                                        data-feather="x-circle"></span>Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="edit{{ $i->id }}">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Kelas</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url("/kelas/$i->id") }}" method="POST"
                                                                enctype="multipart/form-data">
                                                                @method('PATCH')
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label>Nama</label>
                                                                    <input type="text" name="nama"
                                                                        value="{{ $i->nama }}" class="form-control"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Harga</label>
                                                                    <input type="number" name="harga"
                                                                        value="{{ $i->harga }}" class="form-control"
                                                                        required>
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
