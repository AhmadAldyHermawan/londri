@extends('layouts.master')
@section('link')
<li class="menu-header">Dashboard</li>
<li ><a class="nav-link" href="{{route ('dashboard')}}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
<li class="menu-header">Content</li>
@if (auth()->user()->role=="admin") 
<li ><a class="nav-link" href="{{route ('tampil-outlet')}}"><i class="fas fa-home"></i> <span>Outlet</span></a></li>
<li ><a class="nav-link" href="{{route ('tampil-paket')}}"><i class="fas fa-box"></i> <span>Paket Laundry</span></a></li>
@endif
<li ><a class="nav-link" href="{{route ('tampil-member')}}"><i class="fas fa-user"></i> <span>Member</span></a></li>
<li class="active"><a class="nav-link" href="{{route ('tampil-transaksi')}}"><i class="fas fa-file-invoice-dollar"></i> <span>Transaksi</span></a></li>
@if (auth()->user()->role=="admin") 
<li ><a class="nav-link" href="{{route ('tampil-user')}}"><i class="fas fa-user-tie"></i> <span>Data Pengurus</span></a></li>
@endif
@stop
@section('content')
    <div class="section-body">
      <div class="section-header">
        <h1>Transaksi Laundry</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{route('tampil-transaksi')}}">Transaksi</a></div>
          <div class="breadcrumb-item">Edit Transaksi</div>
        </div>
      </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                      <div class="card">
                        <div class="card-header">
                          <h4>Edit Data Transaksi</h4>
                        </div>
                        <form action="{{route('update-transaksi', $transaksi->id)}}" method="POST">
                          @csrf
                          @method('put')
                        <div class="card-body">
                          
                            <div class="row">
                              <div class="col-md-3">
                          <div class="form-group">
                            <label>Outlet:</label>
                            <br>
                            <select class="form-control col-md-8" name="id_outlet">
                            {{-- <option value="" selected>--Pilih--</option>   --}}
                            {{-- <option value="{{$paket->id_outlet}}" selected>{{$outlet->nama}}</option> --}}
                            @foreach ($outlet as $data)
                            {{-- @if ($outlet->id != $outlet->id) --}}
                            <option value="{{$data->id}}"{{old('id_outlet',$transaksi->id_outlet) == $data->id  ? "selected" : ''}}>{{$data->nama}}</option>
                            {{-- @endif --}}
                            @endforeach 
                            </select>  
                            <label 
                            @error('id_outlet') 
                            class="text-danger"
                            @enderror>
                            @error('id_outlet')
                            {{$message}}
                            @enderror
                          </label>
                        </div>
                      </div>
                        
                      <div class="col-md-3">
                          <div class="form-group">
                            <label>Member:</label>
                              <br>
                              <select class="form-control col-md-8" name="id_member">
                              
                              @foreach ($member as $data)
                              
                              <option value="{{$data->id}}"{{old('id_member',$transaksi->id_member) == $data->id  ? "selected" : ''}}>{{$data->nama_member}}</option>
                              
                              @endforeach 
                              </select>  
                              <label 
                              @error('id_member') 
                              class="text-danger"
                              @enderror>
                              @error('id_member')
                              {{$message}}
                              @enderror
                            </label>
                        </div>
                      </div>
                        
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Pilih Paket :</label>
                          <br>
                          <select class="form-control col-md-8" name="id_paket">
                          
                          @foreach ($paket as $data)
                          <option value="{{$data->id}}"{{old('id_paket',$transaksi->id_paket) == $data->id  ? "selected" : ''}}>{{$data->nama_paket}} - Rp.{{$data->harga}}</option>  
                          @endforeach
                          </select>  
                          <label 
                          @error('id_paket') 
                          class="text-danger"
                          @enderror>
                          @error('id_paket')
                          {{$message}}
                          @enderror
                        </label>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Berat :</label>
                        <div class="input-group mb-2 mr-sm-2">
                        <input type="number" min="1" name="qty" 
                        @if (old('qty'))
                            value="{{old('qty')}}"
                        @else
                            value="{{$transaksi->qty}}"
                        @endif

                        class="form-control col-md-8" >
                        <div class="input-group-prepend">
                          <div class="input-group-text">Kg</div>
                        </div>
                      </div>
                        <label 
                        @error('qty') 
                        class="text-danger"
                        @enderror>
                        @error('qty')
                        {{$message}}
                        @enderror
                      </label>
                      </div>
                    </div>
                  </div>

 

                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                            <label>Tanggal Transaksi :</label>
                            <input type="date" name="tgl"
                            @if (old('tgl'))
                      value="{{old('tgl')}}" 
                      @else
                      value="{{$transaksi->tgl}}" 
                      @endif
                            class="form-control col-md-6" disabled>
                            <input type="date" name="tgl"
                            @if (old('tgl'))
                      value="{{old('tgl')}}" 
                      @else
                      value="{{$transaksi->tgl}}" 
                      @endif
                            class="form-control col-md-6" hidden>
                            <label 
                            @error('tgl') 
                            class="text-danger"
                            @enderror>
                            @error('tgl')
                            {{$message}}
                            @enderror
                          </label>
                          </div>
                          </div>

                          <div class="col-md-4">
                          <div class="form-group">
                            <label>Batas Waktu :</label>
                            <input type="date" name="batas_waktu" 
                            @if (old('batas_waktu'))
                                value="{{old('batas_waktu')}}"
                            @else
                            value="{{$transaksi->batas_waktu}}"
                            @endif
                            class="form-control col-md-6" disabled>
                            <input type="date" name="batas_waktu" 
                            @if (old('batas_waktu'))
                                value="{{old('batas_waktu')}}"
                            @else
                            value="{{$transaksi->batas_waktu}}"
                            @endif
                            class="form-control col-md-6" hidden>
                            <label 
                            @error('batas_waktu') 
                            class="text-danger"
                            @enderror>
                            @error('batas_waktu')
                            {{$message}}
                            @enderror
                          </label>
                          </div>
                          </div>
                          
                          <div class="col-md-4">
                          <div class="form-group">
                            <label>Tanggal Bayar :</label>
                            <input type="date" name="tgl_bayar"
                            @if (old('tgl_bayar'))
                                value="{{old('tgl_bayar')}}"
                            @else
                                value="{{$transaksi->tgl_bayar}}"
                            @endif
                            class="form-control col-md-6" >
                            <label 
                            @error('tgl_bayar') 
                            class="text-danger"
                            @enderror>
                            @error('tgl_bayar')
                            {{$message}}
                            @enderror
                          </label>
                          </div>
                          </div>
                        </div>

                        <div class="row">

                       <div class="col-md-4">
                          <div class="form-group">
                            <label>Status :</label>
                            <br>
                            <select name="status"
                            class="form-control col-md-6" >
                            {{-- <option value="" selected>--Pilih--</option> --}}
                            <option value="proses"{{ old('status', $transaksi->status) == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai"{{ old('status', $transaksi->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="diambil"{{ old('status', $transaksi->status) == 'diambil' ? 'selected' : '' }}>Diambil</option>
                            </select> 
                            <label 
                            @error('status') 
                            class="text-danger"
                            @enderror>
                            @error('status')
                            {{$message}}
                            @enderror
                          </label>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Status Bayar :</label>
                            <br>
                            <select name="dibayar"
                            class="form-control col-md-6" >
                            {{-- <option value="" selected>--Pilih--</option> --}}
                            <option value="dibayar"{{ old('dibayar', $transaksi->dibayar) == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                            <option value="belum_dibayar"{{ old('dibayar', $transaksi->dibayar) == 'belum_dibayar' ? 'selected' : '' }}>Belum dibayar</option>
                            </select> 
                            <label 
                            @error('dibayar') 
                            class="text-danger"
                            @enderror>
                            @error('dibayar')
                            {{$message}}
                            @enderror
                          </label>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                          <label>Nama Petugas :</label>
                          <div class="input-group mb-2 mr-sm-2">
                            <input type="text" 
                            @if (old('name'))
                                value="{{old('name')}}"
                            @else
                                value="{{$user->name}}"
                            @endif
    
                            class="form-control col-md-6" disabled>
                            <input type="text"  name="id_petugas" 
                            @if (old('id_petugas'))
                                value="{{old('id_petugas')}}"
                            @else
                                value="{{$user->id}}"
                            @endif
    
                            class="form-control col-md-6" hidden>
                            <label 
                            @error('id_petugas') 
                            class="text-danger"
                            @enderror>
                            @error('id_petugas')
                            {{$message}}
                            @enderror
                          </label>
                        </div>
                        </div>
                        </div>

                        </div>

                          <button class="btn btn-primary" type="submit">Simpan</button>
                          <button class="btn btn-secondary" type="reset">Reset</button>
                        
                  </div>
                        </form>
                  </div>
            </div>
         </div>

    </div>
@stop



@push('scripts')

@endpush