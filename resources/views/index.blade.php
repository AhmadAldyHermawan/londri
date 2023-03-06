@extends('layouts.master')
@section('link') 
<li class="menu-header">Dashboard</li>
<li class="active"><a class="nav-link" href="{{route ('dashboard')}}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
<li class="menu-header">Menu</li>
@if (auth()->user()->role=="admin") 
<li ><a class="nav-link" href="{{route ('tampil-outlet')}}"><i class="fas fa-home"></i> <span>Outlet</span></a></li>
<li ><a class="nav-link" href="{{route ('tampil-paket')}}"><i class="fas fa-box"></i> <span>Paket Laundry</span></a></li>
@endif

@if (auth()->user()->role != "owner") 
<li ><a class="nav-link" href="{{route ('tampil-member')}}"><i class="fas fa-user"></i> <span>Member</span></a></li>
@endif

<li ><a class="nav-link" href="{{route ('tampil-transaksi')}}"><i class="fas fa-file-invoice-dollar"></i> <span>Transaksi</span></a></li>

@if (auth()->user()->role=="admin") 
<li ><a class="nav-link" href="{{route ('tampil-user')}}"><i class="fas fa-user-tie"></i> <span>Data Pengurus</span></a></li>
@endif

@stop
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>DASHBOARD</h1>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
          <i class="fas fa-store"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Outlet</h4>
            </div>
            <div class="card-body">
              {{ $outlet->count() }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
          <i class="fas fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Member</h4>
            </div>
            <div class="card-body">
              {{ $member->count() }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-box"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Paket Laundry</h4>
            </div>
            <div class="card-body">
              {{ $paket->count() }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
          <i class="fas fa-hand-holding-usd"></i>
          </div>
          <div class="card-wrap ">
            <div class="card-header">
              <h4>Pemesanan</h4>
            </div>
            <div class="card-body">
              {{ $transaksi_count->count() }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-info">
          <i class="fas fa-dollar-sign"></i>
          </div>
          <div class="card-wrap ">
            <div class="card-header">
              <h4>Selesai</h4>
            </div>
            <div class="card-body">
              {{ $transaksi_selesai->count() }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-secondary">
          <i class="fas fa-vote-yea"></i>
          </div>
          <div class="card-wrap ">
            <div class="card-header">
              <h4>Total Pendapatan</h4>
            </div>
            <div class="card-body">
              Rp. {{ $total }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
          <div class="card-header mt-3">
            <h4>Transaksi Terakhir</h4>
            <div class="card-header-action">
              <a href="{{route('tampil-transaksi')}}" class="btn btn-primary">Lihat Semua Transaksi</a>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive-md">
            <table class="table table-striped table-hover" >
              <tr class="thead-light">
                <th>No</th>
                    <th>Outlet</th>
                    <th>Nama Member</th>
                    <th>Nama Petugas</th>
                    <th>Tanggal Transaksi</th>
                    <th>Batas Waktu</th>
                    <th>Tanggal Bayar</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
              </tr>
            
              @foreach ($transaksi as $no => $data)
              <tr>
                <td>{{$no+1}}</td>
                <td>{{$data->outlet->nama}}</td>
                <td>{{$data->member->nama_member}}</td>
                <td>{{$data->user->name}}</td>
                <td>{{$data->tgl}}</td>
                <td>{{$data->batas_waktu}}</td>
                <td>{{$data->tgl_bayar}}</td>
                <td>{{$data->status}}</td>
                <td>{{$data->dibayar}}</td>

              </tr>
              @endforeach
              

            </table>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@stop



@push('scripts')

@endpush