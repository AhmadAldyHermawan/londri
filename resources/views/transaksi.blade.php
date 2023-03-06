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
<div class="section-header">
    <h1>Transaksi Laundry</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
      <div class="breadcrumb-item"><a href="{{route('tampil-transaksi')}}">Transaksi</a></div>
      <div class="breadcrumb-item">Data Transaksi</div>
    </div>
  </div>
    <div class="section-body" >
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
              <div class="card-body bg-white">
              <form class="form-inline text-center" action="{{route('cari-transaksi')}}">
                <div class="search-element">
                  <input class="form-control" name="cari" value="{{ old('cari') }}" type="search" placeholder="Cari Data Transaksi..." aria-label="Search" data-width="500">
                  <button class="btn btn-info" type="submit" value="cari"><i class="fas fa-search"></i></button>
                </div>
                @if (auth()->user()->role != "owner") 
                <a href="{{route ('tambah-transaksi')}}" class="btn btn-icon icon-left btn-primary m-4"><i class="fas fa-clipboard-list"></i> Tambah Data</a>
                @endif
              </form>

                {{-- <a href="#" class="btn btn-icon icon-left btn-success"><i class="fas fa-clipboard-list"></i> Export Data</a> --}}
                <hr>
                {{-- message simpan data --}}
                @if (session('message-simpan'))
                <div class="alert alert-success alert-dismissible show fade">
                  <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>×</span>
                    </button>
                    {{(session('message-simpan'))}}
                  </div>
                </div>
                @endif
                {{-- message update data --}}
                @if (session('message-update'))
                <div class="alert alert-info alert-dismissible show fade">
                  <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>×</span>
                    </button>
                    {{(session('message-update'))}}
                  </div>
                </div>
                @endif
                {{-- message hapus data --}}
                @if (session('message-hapus'))
                <div class="alert alert-warning alert-dismissible show fade">
                  <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>×</span>
                    </button>
                    {{(session('message-hapus'))}}
                  </div>
                </div>
                @endif
                <div class="table-responsive-md mt-3">
                  <table class="table table-striped table-hover" >
                  <tr class="thead-light">
                    <th>No</th>
                    <th>Outlet</th>
                    <th>Nama Member</th>
                    <th>Nama Petugas</th>
                    <th>Tanggal Transaksi</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                    {{-- <th>Batas Waktu</th>
                    <th>Tanggal Bayar</th>
                    
                    <th>Pembayaran</th> --}}
                    <th>Aksi</th>
                  </tr>
                  
                  @foreach ($transaksi as $no => $data)
                  
                  <tr>
                    <td>{{$transaksi->firstItem()+$no}}</td>
                    <td>{{$data->nama}}</td>
                    <td>{{$data->nama_member}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->tgl}}</td>
                    <td>{{$data->status}}</td>
                    <td>{{$data->dibayar}}</td>
                    {{-- <td>{{$data->batas_waktu}}</td>
                    <td>{{$data->tgl_bayar}}</td>
                     --}}
                    
                    <td>
                      <a href=" {{route('tampil-detail',$data->id_transaksi)}}" class="btn btn-icon btn-success" ><i class="fas fa-eye"></i><a>
                        @if (auth()->user()->role != "owner") 
                        <a href="{{route('edit-transaksi',$data->id_transaksi)}}" class="btn btn-icon btn-warning"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" data-id="{{$data->id_transaksi}}" class="btn btn-icon btn-danger hapus">
                        <form action="{{route('hapus-transaksi',$data->id_transaksi)}}" id="hapus{{$data->id_transaksi}}"method="POST">
                          @csrf
                          @method('delete')
                        </form>
                        <i class="fas fa-trash"></i>
                      </a>
                      @endif
                    </td>
                  </tr>
                  @endforeach

                </table>
                </div>
                {{$transaksi->links()}}
            </div>
            </div>
         </div>

    </div>
@stop

@push('scripts')
<script src="../node_modules/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@push('after-scripts')
<script>
$(".hapus").click(function(hapus) {
  id = hapus.target.dataset.id;
  swal({
      title: 'Hapus data?',
      text: 'Data yang dihapus tidak bisa dikembalikan!',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
      // swal('Poof! Your imaginary file has been deleted!', {
      //   icon: 'success',
      // });
      $(`#hapus${id}`).submit();
      } else {
      // swal('Your imaginary file is safe!');
      }
    });
});
</script>
@endpush