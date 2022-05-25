@extends('layouts.app')
@section('content')

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fa fa-users"></i>
                        Kelola Staff
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h4>Data Staff Departemen {{ Auth::user()->departemen->nama }}</h4>
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-tambah" data-bs-toggle="modal" data-bs-target="#modal-tambah">
                            <i class="fa fa-plus"></i>
                            Tambah Staff
                        </button>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nim</th>
                                <th>Departemen</th>
                                <th>Keaktifan</th>
                                <th>Tepat Waktu</th>
                                <th>Kontribusi</th>
                                <th>Sikap</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staff as $sf)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sf->nama }}</td>
                                <td>{{ $sf->nim }}</td>
                                <td>{{ $sf->departemen->nama }}</td>
                                <td>{{ $sf->keaktifan }}</td>
                                <td>{{ $sf->tepat_waktu }}</td>
                                <td>{{ $sf->kontribusi }}</td>
                                <td>{{ $sf->sikap }}</td>
                                <td>
                                    {{-- button to open modal edit and delete --}}
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $sf->id }}" >
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $sf->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Staff</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/kelola-staff/tambah" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="nim">Nim</label>
                            <input type="text" class="form-control" id="nim" name="nim">
                        </div>
                        <div class="form-group">
                            <label for="keaktifan">Keaktifan</label>
                            <select name="keaktifan" id="keaktifan" class="form-control">
                                @foreach ($nilai as $ni)
                                    <option value="{{ $ni }}">{{ $ni }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tepat_waktu">Tepat Waktu</label>
                            <select name="tepat_waktu" id="tepat_waktu" class="form-control">
                                @foreach ($nilai as $ni)
                                    <option value="{{ $ni }}">{{ $ni }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kontribusi">Kontribusi</label>
                            <select name="kontribusi" id="kontribusi" class="form-control">
                                @foreach ($nilai as $ni)
                                    <option value="{{ $ni }}">{{ $ni }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sikap">Sikap</label>
                            <select name="sikap" id="sikap" class="form-control">
                                @foreach ($nilai as $ni)
                                    <option value="{{ $ni }}">{{ $ni }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($staff as $sf)
    <div class="modal fade" id="editModal{{ $sf->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Staff</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/kelola-staff/edit/{{ $sf->id }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $sf->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="nim">Nim</label>
                            <input type="text" class="form-control" id="nim" name="nim" value="{{ $sf->nim }}">
                        </div>
                        <div class="form-group">
                            <label for="keaktifan">Keaktifan</label>
                            <select name="keaktifan" id="keaktifan" class="form-control">
                                @foreach ($nilai as $ni)
                                    <option value="{{ $ni }}" {{ $sf->keaktifan == $ni ? 'selected' : '' }}>{{ $ni }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tepat_waktu">Tepat Waktu</label>
                            <select name="tepat_waktu" id="tepat_waktu" class="form-control">
                                @foreach ($nilai as $ni)
                                    <option value="{{ $ni }}" {{ $sf->tepat_waktu == $ni ? 'selected' : '' }}>{{ $ni }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kontribusi">Kontribusi</label>
                            <select name="kontribusi" id="kontribusi" class="form-control">
                                @foreach ($nilai as $ni)
                                    <option value="{{ $ni }}" {{ $sf->kontribusi == $ni ? 'selected' : '' }}>{{ $ni }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sikap">Sikap</label>
                            <select name="sikap" id="sikap" class="form-control">
                                @foreach ($nilai as $ni)
                                    <option value="{{ $ni }}" {{ $sf->sikap == $ni ? 'selected' : '' }}>{{ $ni }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal{{ $sf->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Staff</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/kelola-staff/hapus/{{ $sf->id }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $sf->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nim">Nim</label>
                            <input type="text" class="form-control" id="nim" name="nim" value="{{ $sf->nim }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="keaktifan">Keaktifan</label>
                            <input type="text" class="form-control" id="keaktifan" name="keaktifan" value="{{ $sf->keaktifan }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tepat_waktu">Tepat Waktu</label>
                            <input type="text" class="form-control" id="tepat_waktu" name="tepat_waktu" value="{{ $sf->tepat_waktu }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="kontribusi">Kontribusi</label>
                            <input type="text" class="form-control" id="kontribusi" name="kontribusi" value="{{ $sf->kontribusi }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="sikap">Sikap</label>
                            <input type="text" class="form-control" id="sikap" name="sikap" value="{{ $sf->sikap }}" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach


@endsection
@section("css")
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset("template") }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset("template") }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection
@section("script")
<!-- DataTables -->
<script src="{{ asset("template") }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset("template") }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset("template") }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset("template") }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
    
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
    });
</script>
@endsection
