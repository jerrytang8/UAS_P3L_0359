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
                        <h4 class="card-title">Tambah Aktivasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ url('/aktivasi/save') }}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>No Struk</label>
                                        <input type="text" name="no_struk" class="form-control" value="{{ $aktivasiid }}" required readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Member</label>
                                        <select class="form-control" name="member" required>
                                            <option value="">--Pilih--</option>
                                            @foreach ($member as $m)
                                            <option value="{{ $m->memberid }}">{{ $m->memberid }}/{{ $m->nama }}</option>                                                
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Jumlah</label>
                                        <input type="number" name="jumlah" value="3000000" class="form-control text-right" readonly required>
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
