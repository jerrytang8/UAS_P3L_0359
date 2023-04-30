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
                @if (session()->has('gagal'))                    
                <div class="alert alert-danger solid alert-dismissible fade show">
                    <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    <strong>Gagal!</strong> {{ session('gagal') }}
                    <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                    </button>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Penggantian Instruktur</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ url("/jadwalhar/$data->id/simpaninstruktur") }}" method="POST" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <input type="hidden" name="hari" value="{{ $data->id_hari }}">
                                <input type="hidden" name="waktu" value="{{ $data->id_jam }}">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Instruktur</label>
                                        <select class="form-control" name="instruktur" required>
                                            <option value="">--Pilih--</option>
                                            @foreach ($instruktur as $i)
                                            <option value="{{ $i->id }}" @if ($data->id_instruktur==$i->id)
                                                selected
                                            @endif>{{ $i->nama }}</option>                                                
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Instruktur Pengganti</label>
                                        <select class="form-control" name="instruktur2" required>
                                            <option value="">--Pilih--</option>
                                            @foreach ($instruktur as $i)
                                            <option value="{{ $i->id }}" @if ($data->id_instruktur2==$i->id)
                                                selected
                                            @endif>{{ $i->nama }}</option>                                                
                                            @endforeach
                                        </select>
                                    </divt>
                                </div>
                                <button class="btn btn-primary">Submit</button>
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
