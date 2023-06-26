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
            <div class="col-lg-12">
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
                        <h4 class="card-title">Jadwal Harian</h4>
                        <a href="{{ url('/jadwalhar/generate') }}" class="btn btn-primary light btn-md ml-auto">
                            <i class="fa fa-random scale5 mr-3"></i>Generate Jadwal
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display min-w850">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="5%" class="bg-primary text-white">Tanggal</th>
                                        <th width="90%" class="text-center">Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{ dd($jadwal) }} --}}
                                    <?php $no=1; ?>
                                    @foreach ($jadwal as $j)
                                    <tr>
                                        <td>{{ $no++; }}</td>
                                        <th class="bg-primary text-white text-center">
                                            {{ $j['hari'] }}
                                            <br>
                                            {{ $j['bulan'] }}
                                        </th>
                                        <td>
                                            <div class="col-12 row">
                                                @foreach ($j['waktu'] as $w)
                                                <div class="col-2 text-center">
                                                    <p>
                                                        {{ $w['jam'] }}
                                                        <br>
                                                        {{ $w['kelas'] }}
                                                        <br>
                                                        @if ($w['status']==1)
                                                            (Libur)
                                                        @elseif ($w['status']==2)
                                                            {{ $w['instruktur2'] }} <br> (Pengganti {{ $w['instruktur'] }})
                                                        @else
                                                            {{ $w['instruktur'] }}
                                                        @endif
                                                    </p>
                                                    <div class="basic-dropdown">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                Aksi
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <form action="{{ url("/jadwalhar/".$w['id']) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <a class="dropdown-item" href="{{ url("/jadwalhar/".$w['id']."/editinstruktur") }}">Ganti Instruktur</a>
                                                                    <a class="dropdown-item" href="" data-toggle="modal" data-target="#ubahstatus{{ $w['id'] }}">Ubah Status</a>
                                                                    <a class="dropdown-item" href="{{ url("/jadwalhar/".$w['id']."/edit") }}">Edit</a>
                                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda Yakin?')"><span data-feather="x-circle"></span>Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="ubahstatus{{ $w['id'] }}">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Ubah Status</h5>
                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ url("/jadwalhar/".$w['id']."/ubahstatus") }}" method="POST">
                                                                    @method('PATCH')
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label>Status</label>
                                                                        <select class="form-control default-select" name="status" required>
                                                                            <option value="">--Pilih Status--</option>
                                                                            <option value="0" @if ($w['status']==0)
                                                                                selected
                                                                            @endif>Masuk</option>
                                                                            <option value="1" @if ($w['status']==1)
                                                                            selected
                                                                        @endif>Libur</option>
                                                                            <option value="2" @if ($w['status']==2)
                                                                            selected
                                                                        @endif>Ganti Instruktur</option>
                                                                        </select>
                                                                    </div>
                                                                    <button class="btn btn-primary">Submit</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
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
    </div>
</div>
@endsection
@section('script')

@endsection
