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
                            <h4 class="card-title">Presensi Member</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ url('/presensi_gym/save') }}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Member ID</label>
                                            <input type="text" name="member" class="form-control"
                                                value="{{ $memberid }}" required readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Nama</label>
                                            <input type="text" name="nama" class="form-control"
                                                value="{{ $member->nama }}" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>No Struk</label>
                                            <input type="text" name="no_struk" class="form-control"
                                                value="{{ $no_struk }}" required readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Waktu</label>
                                            <select class="form-control" name="waktu" required>
                                                <option value="">--Pilih--</option>
                                                @foreach ($jam as $j)
                                                    <option value="{{ $j->slot }}">{{ $j->slot }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                    <a href="{{ url('/presensi_gym') }}" class="btn btn-danger ml-auto">
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
