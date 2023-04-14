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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Jadwal Default Mingguan</h4>
                        <a href="{{ url('/jadwaldef/tambah') }}" class="btn btn-primary light btn-md ml-auto">
                            <i class="fa fa-plus scale5 mr-3"></i>Tambah Jadwal
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-responsive-sm">
                                {{-- <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col text-center">07:00-09:00</th>
                                        <th scope="col">09:00-11:00</th>
                                        <th scope="col">11:00-13:00</th>
                                        <th scope="col">13:00-15:00</th>
                                        <th scope="col">15:00-17:00</th>
                                        <th scope="col">17:00-19:00</th>
                                        <th scope="col">19:00-21:00</th>
                                    </tr>
                                </thead> --}}
                                {{-- <?php  $jadwal = array(); foreach ($data as $key => $value) {
                                   array_push($jadwal, $value);
                                } ?> --}}
                                <tbody>
                                    <tr>
                                        <th width="5%" class="bg-primary text-white">Senin</th>
                                        <td colspan="7">
                                            <div class="col-12 row">
                                                @foreach ($senin as $sen)                                                  
                                                    <div class="col-2 text-center">
                                                        <p>
                                                            {{ $sen->slot }}
                                                            <br>
                                                            {{ $sen->kelas }}
                                                            <br>
                                                            {{ $sen->instruktur }}
                                                        </p>
                                                        <div class="basic-dropdown">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                    Aksi
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <form action="{{ url("jadwaldef/$sen->id") }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <a class="dropdown-item" href="{{ url("/jadwaldef/$sen->id/edit") }}">Edit</a>
                                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda Yakin?')"><span data-feather="x-circle"></span>Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="5%" class="bg-primary text-white">Selasa</th>
                                        <td colspan="7">
                                            <div class="col-12 row">
                                                @foreach ($selasa as $sen)                                                  
                                                    <div class="col-2 text-center">
                                                        <p>
                                                            {{ $sen->slot }}
                                                            <br>
                                                            {{ $sen->kelas }}
                                                            <br>
                                                            {{ $sen->instruktur }}
                                                        </p>
                                                        <div class="basic-dropdown">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                    Aksi
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <form action="{{ url("jadwaldef/$sen->id") }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <a class="dropdown-item" href="{{ url("/jadwaldef/$sen->id/edit") }}">Edit</a>
                                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda Yakin?')"><span data-feather="x-circle"></span>Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="5%" class="bg-primary text-white">Rabu</th>
                                        <td colspan="7">
                                            <div class="col-12 row">
                                                @foreach ($rabu as $sen)                                                  
                                                    <div class="col-2 text-center">
                                                        <p>
                                                            {{ $sen->slot }}
                                                            <br>
                                                            {{ $sen->kelas }}
                                                            <br>
                                                            {{ $sen->instruktur }}
                                                        </p>
                                                        <div class="basic-dropdown">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                    Aksi
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <form action="{{ url("jadwaldef/$sen->id") }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <a class="dropdown-item" href="{{ url("/jadwaldef/$sen->id/edit") }}">Edit</a>
                                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda Yakin?')"><span data-feather="x-circle"></span>Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="5%" class="bg-primary text-white">Kamis</th>
                                        <td colspan="7">
                                            <div class="col-12 row">
                                                @foreach ($kamis as $sen)                                                  
                                                    <div class="col-2 text-center">
                                                        <p>
                                                            {{ $sen->slot }}
                                                            <br>
                                                            {{ $sen->kelas }}
                                                            <br>
                                                            {{ $sen->instruktur }}
                                                        </p>
                                                        <div class="basic-dropdown">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                    Aksi
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <form action="{{ url("jadwaldef/$sen->id") }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <a class="dropdown-item" href="{{ url("/jadwaldef/$sen->id/edit") }}">Edit</a>
                                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda Yakin?')"><span data-feather="x-circle"></span>Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="5%" class="bg-primary text-white">Jum'at</th>
                                        <td colspan="7">
                                            <div class="col-12 row">
                                                @foreach ($jumat as $sen)                                                  
                                                    <div class="col-2 text-center">
                                                        <p>
                                                            {{ $sen->slot }}
                                                            <br>
                                                            {{ $sen->kelas }}
                                                            <br>
                                                            {{ $sen->instruktur }}
                                                        </p>
                                                        <div class="basic-dropdown">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                    Aksi
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <form action="{{ url("jadwaldef/$sen->id") }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <a class="dropdown-item" href="{{ url("/jadwaldef/$sen->id/edit") }}">Edit</a>
                                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda Yakin?')"><span data-feather="x-circle"></span>Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="5%" class="bg-primary text-white">Sabtu</th>
                                        <td colspan="7">
                                            <div class="col-12 row">
                                                @foreach ($sabtu as $sen)                                                  
                                                    <div class="col-2 text-center">
                                                        <p>
                                                            {{ $sen->slot }}
                                                            <br>
                                                            {{ $sen->kelas }}
                                                            <br>
                                                            {{ $sen->instruktur }}
                                                        </p>
                                                        <div class="basic-dropdown">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                    Aksi
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <form action="{{ url("jadwaldef/$sen->id") }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <a class="dropdown-item" href="{{ url("/jadwaldef/$sen->id/edit") }}">Edit</a>
                                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda Yakin?')"><span data-feather="x-circle"></span>Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="5%" class="bg-primary text-white">Minggu</th>
                                        <td colspan="7">
                                            <div class="col-12 row">
                                                @foreach ($minggu as $sen)                                                  
                                                    <div class="col-2 text-center">
                                                        <p>
                                                            {{ $sen->slot }}
                                                            <br>
                                                            {{ $sen->kelas }}
                                                            <br>
                                                            {{ $sen->instruktur }}
                                                        </p>
                                                        <div class="basic-dropdown">
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                    Aksi
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <form action="{{ url("jadwaldef/$sen->id") }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <a class="dropdown-item" href="{{ url("/jadwaldef/$sen->id/edit") }}">Edit</a>
                                                                        <button type="submit" class="dropdown-item" onclick="return confirm('Apakah Anda Yakin?')"><span data-feather="x-circle"></span>Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
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
