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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Member</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ url('/member/save') }}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Member ID</label>
                                        <input type="text" name="memberid" class="form-control" value="{{ $memberid }}" required readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Alamat</label>
                                        <textarea class="form-control" name="alamat" rows="4" required></textarea>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control default-select" name="jenis_kelamin" required>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>No. Telp</label>
                                        <input type="number" name="no_telp" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" name="tgl_lahir" class="form-control" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                                <a href="{{ url('/member') }}" class="btn btn-danger ml-auto">
                                    Batal
                                </a>
                            </form>
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
