@extends('layouts.app')
@section('content')


    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{-- table rank staff of the month --}}
                    <div class="card-title">
                        <i class="fa fa-users"></i>
                        Rank Staff Of The Month
                    </div>
                </div>
                @if(Auth::user()->role == "super")
                <div class="card-body">
                    <h4>Rank keseluruhan</h4>
                    <table class="table table-striped table-bordered table-hover" id="example1">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Nama</th>
                                <th>Nim</th>
                                <th>Departemen</th>
                                <th>Keaktifan</th>
                                <th>Tepat Waktu</th>
                                <th>Kontribusi</th>
                                <th>Sikap</th>
                                <th>Nilai (Maut)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semua as $sm)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sm->nama }}</td>
                                <td>{{ $sm->nim }}</td>
                                <td>{{ $sm->departemen->nama }}</td>
                                <td>{{ $sm->keaktifan }}</td>
                                <td>{{ $sm->tepat_waktu }}</td>
                                <td>{{ $sm->kontribusi }}</td>
                                <td>{{ $sm->sikap }}</td>
                                <td>{{ $sm->nilai }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="card-body">
                    <h4>Rank staff departemen {{ Auth::user()->departemen->nama }}</h4>
                    <table class="table table-striped table-bordered table-hover" id="example1">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Nama</th>
                                <th>Nim</th>
                                <th>Departemen</th>
                                <th>Keaktifan</th>
                                <th>Tepat Waktu</th>
                                <th>Kontribusi</th>
                                <th>Sikap</th>
                                <th>Nilai (Maut)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rank_dep as $rd)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $rd->nama }}</td>
                                <td>{{ $rd->nim }}</td>
                                <td>{{ $rd->departemen->nama }}</td>
                                <td>{{ $rd->keaktifan }}</td>
                                <td>{{ $rd->tepat_waktu }}</td>
                                <td>{{ $rd->kontribusi }}</td>
                                <td>{{ $rd->sikap }}</td>
                                <td>{{ $rd->nilai }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
    @if(Auth::user()->role == "super")
        @foreach ($departemen_arr as $key => $value)
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{-- table rank staff of the month --}}
                        <div class="card-title">
                            <i class="fa fa-users"></i>
                            Rank Staff Of The Month Departemen {{ $key }}
                        </div>
                    </div>
                    <div class="card-body">
                        <h4>Rank Staff {{ $key }}</h4>
                        <table class="table table-striped table-bordered table-hover" id="example_{{ $value[0]->id_departemen }}">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Nama</th>
                                    <th>Nim</th>
                                    <th>Departemen</th>
                                    <th>Keaktifan</th>
                                    <th>Tepat Waktu</th>
                                    <th>Kontribusi</th>
                                    <th>Sikap</th>
                                    <th>Nilai (Maut)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($value as $vl)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $vl->nama }}</td>
                                    <td>{{ $vl->nim }}</td>
                                    <td>{{ $vl->departemen->nama }}</td>
                                    <td>{{ $vl->keaktifan }}</td>
                                    <td>{{ $vl->tepat_waktu }}</td>
                                    <td>{{ $vl->kontribusi }}</td>
                                    <td>{{ $vl->sikap }}</td>
                                    <td>{{ $vl->nilai }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
    

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
    @foreach ($departemen_arr as $key => $value)
        $("#example_{{ $value[0]->id_departemen }}").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    @endforeach
    });
</script>
@endsection
