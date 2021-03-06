@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card-header bg-dark">
                <div class="pull-left">
                    <h2 class="text-light">Data Transaksi</h2>
                </div>
            </div>

            <div class="card-header bg-dark text-white">

                <form action="{{route('caritgl')}}" method="get">
                    @csrf
                    <div class="form-group row">
                        <label for="from" class="col-form-label col-sm-2">Dari Tanggal</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control input-sm w-100" id="from" name="from" required>
                        </div>
                        <label for="to" class="col-form-label col-sm-2">Sampai Tanggal</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control input-sm w-100" id="to" name="to" required>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-secondary text-light mb-1">Cari</button>
                        </div>
                    </div>
                </form>

            </div>

            <div class="card-header bg-dark">
                <div class="row">
                    <div class="col-4">
                        <form action="{{route('tgltertentu')}}" method="get">
                            @csrf
                            <input type="date" placeholder="Cari Tanggal" name="search" class="form-control w-75 d-inline" required>
                            <button type="submit" class="btn btn-secondary text-light">Cari</button>
                        </form>
                    </div>
                    <div class="col-4">
                        <form action="{{route('laporantransaksi')}}" method="get">
                            @csrf
                            <input type="text" placeholder="Cari Nama Pegawai" name="search" class="form-control w-75 d-inline" required>
                            <button type="submit" class="btn btn-secondary text-light mb-1">Cari</button>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card-header">

            </div>
            <div class="container-fluid">
                <div class="row">
                    <table class="table table-hover table-bordered">
                        <tr class="text-dark" s>
                            <th>Nama Pemesan</th>
                            <th>Nama Menu</th>
                            <th>Jumlah Menu</th>
                            <!-- TOTAL HARGA MENU YANG DIBELI PEMESAN/PELANGGAN -->
                            <th>Total Harga Menu</th>
                            <th>Nama Pegawai</th>
                            <th>Tanggal</th>
                        </tr>
                        @foreach($data as $key=>$u)
                        <tr>
                            <td>{{$u->nama_pemesan}}</td>
                            <td>{{$u->nama_menu}}</td>
                            <td>{{$u->jumlah}}</td>
                            <td>{{$u->total_beli}}</td>
                            <td>{{$u->nama_pegawai}}</td>
                            <td>
                                {{$u->created_at}}
                                <!-- <a href="createkasir" class="btn btn-warning">Pesan</a> -->
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="col">
                        <h4>Hari ini Rp. </h4>
                        <hr>
                        <h4>Bulan ini Rp. </h4>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-success" type="submit" value="Print Semua Pemasukan">
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endsection
