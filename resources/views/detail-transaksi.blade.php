@extends('layouts.master')
@section('link')
<li class="menu-header">Dashboard</li>
<li ><a class="nav-link" href="{{route ('dashboard')}}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
<li class="menu-header">Content</li>
@if (auth()->user()->role=="admin") 
<li ><a class="nav-link" href="{{route ('tampil-outlet')}}"><i class="fas fa-home"></i> <span>Outlet</span></a></li>
<li ><a class="nav-link" href="{{route ('tampil-paket')}}"><i class="fas fa-box"></i> <span>Paket Laundry</span></a></li>
@endif
@if (auth()->user()->role != "owner") 
<li ><a class="nav-link" href="{{route ('tampil-member')}}"><i class="fas fa-user"></i> <span>Member</span></a></li>
@endif
<li class="active"><a class="nav-link" href="{{route ('tampil-transaksi')}}"><i class="fas fa-file-invoice-dollar"></i> <span>Transaksi</span></a></li>
@if (auth()->user()->role=="admin") 
<li ><a class="nav-link" href="{{route ('tampil-user')}}"><i class="fas fa-user-tie"></i> <span>Data Pengurus</span></a></li>
@endif
@stop
@section('content')
    <div class="section-body" >
      <div class="section-header">
        <h1>Detail Transaksi</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{route('tampil-transaksi')}}">Transaksi</a></div>
          <div class="breadcrumb-item">Detail Transaksi</div>
        </div>
      </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                      <div class="card">
                        <div class="card-header">
                          <h4>Detail Transaksi</h4>
                        </div>
                        <div class="card">

                          <table class="table">
                            <tr>
                              <th>Outlet</th>
                              <th>Nama Member</th>
                              <th>Jenis Paket</th>
                              <th>Berat</th>
                              <th>Total harga</th>
                              <th>Tanggal Transaksi</th>
                              <th>Batas Waktu</th>
                              <th>Tanggal Bayar</th>
                              <th>Status</th>
                              <th>Pembayaran</th>
                            </tr>
                            
                            
                            <tr>
                              {{-- <td>{{$detail->firstItem()+$no}}</td> --}}
                             
                              <td>{{$outlet->nama}}</td>
                             
                              
                              <td>{{$member->nama_member}}</td>
                             
                             
                              <td>{{$paket->nama_paket}}</td>
                              
                              <td>{{$transaksi->qty}} Kg</td>
                              <td>Rp. {{$detail->subtotal}}</td>
                              <td>{{$transaksi->tgl}}</td>
                              <td>{{$transaksi->batas_waktu}}</td>
                              <td>{{$transaksi->tgl_bayar}}</td>
                              <td>{{$transaksi->status}}</td>
                              <td>{{$transaksi->dibayar}}</td>
                            </tr>
                            
                            {{-- <td>{{$data->nama}}</td>
                    <td>{{$data->nama_member}}</td>
                    <td>{{$data->tgl}}</td>
                    <td>{{$data->batas_waktu}}</td>
                    <td>{{$data->tgl_bayar}}</td>
                    <td>{{$data->status}}</td>
                    <td>{{$data->dibayar}}</td> --}}

                          </table>

                        </div>
                        <div class="card-footer text-left">
                          <a href="{{route('tampil-transaksi')}}" class="btn btn-primary">Back</a>
                          <a href="{{route('laporan',$transaksi->id)}}" class="btn btn-success">Generate Laporan</a>
                        </div>

                      </div>                
                  </div>
                        </form>
            </div>
         </div>

    </div>
@stop



@push('scripts')

@endpush