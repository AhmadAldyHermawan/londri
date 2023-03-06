@extends('layouts.master')
@section('link')
<li class="menu-header">Dashboard</li>
<li ><a class="nav-link" href="{{route ('dashboard')}}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
<li class="menu-header">Content</li>
@if (auth()->user()->role=="admin") 
<li ><a class="nav-link" href="{{route ('tampil-outlet')}}"><i class="fas fa-home"></i> <span>Outlet</span></a></li>
<li class="active"><a class="nav-link" href="{{route ('tampil-paket')}}"><i class="fas fa-box"></i> <span>Paket Laundry</span></a></li>
@endif
<li ><a class="nav-link" href="{{route ('tampil-member')}}"><i class="fas fa-user"></i> <span>Member</span></a></li>
<li ><a class="nav-link" href="{{route ('tampil-transaksi')}}"><i class="fas fa-file-invoice-dollar"></i> <span>Transaksi</span></a></li>
@if (auth()->user()->role=="admin") 
<li ><a class="nav-link" href="{{route ('tampil-user')}}"><i class="fas fa-user-tie"></i> <span>Data Pengurus</span></a></li>
@endif
@stop
@section('content')
<div class="section-header">
    <h1>Data Paket</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
      <div class="breadcrumb-item"><a href="{{route('tampil-paket')}}">Paket</a></div>
      <div class="breadcrumb-item">Data Paket</div>
    </div>
  </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
              <div class="card-body bg-white">
              <form class="form-inline text-center" action="{{route('cari-paket')}}">
                <div class="search-element">
                  <input class="form-control" name="cari" value="{{ old('cari') }}" type="search" placeholder="Cari Data Paket..." aria-label="Search" data-width="500">
                  <button class="btn btn-info" type="submit" value="cari"><i class="fas fa-search"></i></button>
                </div>
                <a href="{{route ('tambah-paket')}}" class="btn btn-icon icon-left btn-primary m-4"><i class="fas fa-clipboard-list"></i> Tambah Data</a>
              </form>
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
                {{-- message gagal --}}
                @if (session('message-gagal'))
                <div class="alert alert-danger alert-dismissible show fade">
                  <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>×</span>
                    </button>
                    {{(session('message-gagal'))}}
                  </div>
                </div>
                @endif

                <div class="table-responsive-md mt-3">
                  <table class="table table-striped table-hover" >
                  <tr class="thead-light">
                    <th>No</th>
                    <th>Nama Paket</th>
                    <th>Jenis Paket</th>
                    <th>Outlet</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                  </tr>
                  
                  @foreach ($paket as $no => $data)
                  
                  <tr>
                    <td>{{$paket->firstItem()+$no}}</td>
                    <td>{{$data->nama_paket}}</td>
                    <td>{{$data->jenis}}</td>
                    <td>{{$data->nama}}</td>
                    <td>{{$data->harga}}</td>

                    <td>
                      <a href="{{route('edit-paket',$data->id)}}" class="btn btn-icon btn-warning"><i class="fas fa-pencil-alt"></i></a>
                      <a data-id="{{$data->id}}" class="btn btn-icon btn-danger text-white hapus">
                      <form action="{{route('hapus-paket',$data->id)}}" id="hapus{{$data->id}}"method="POST">
                      @csrf
                      @method('delete')
                      </form>
                      <i class="fas fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                  @endforeach

                </table>
                </div>
                {{$paket->links()}}
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