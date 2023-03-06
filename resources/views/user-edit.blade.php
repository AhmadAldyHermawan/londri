@extends('layouts.master')
@section('link') 
<li class="menu-header">Dashboard</li>
<li class="active"><a class="nav-link" href="{{route ('dashboard')}}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
<li class="menu-header">Content</li>
@if (auth()->user()->role=="admin") 
<li ><a class="nav-link" href="{{route ('tampil-outlet')}}"><i class="fas fa-home"></i> <span>Outlet</span></a></li>
<li ><a class="nav-link" href="{{route ('tampil-paket')}}"><i class="fas fa-box"></i> <span>Paket Laundry</span></a></li>
@endif
@if (auth()->user()->role !="owner") 
<li ><a class="nav-link" href="{{route ('tampil-member')}}"><i class="fas fa-user"></i> <span>Member</span></a></li>
@endif
<li ><a class="nav-link" href="{{route ('tampil-transaksi')}}"><i class="fas fa-file-invoice-dollar"></i> <span>Transaksi</span></a></li>
@if (auth()->user()->role=="admin") 
<li ><a class="nav-link" href="{{route ('tampil-user')}}"><i class="fas fa-user-tie"></i> <span>Data Pengurus</span></a></li>
@endif

@stop
@section('content')
  <!-- Main Content -->
 
    <section class="section">
      <div class="section-header">
        <h1>Profile</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
          <div class="breadcrumb-item">Profile</div>
        </div>
      </div>
      <div class="section-body">
    <h2 class="section-title">Hi, {{Auth::user()->name}}</h2>
        <p class="section-lead">
          Edit Profile Anda
        </p>

        <div class="col-12 col-md-12 col-lg-12">
           
            <div class="card">
              <div class="card-header"> 
                <h4>Edit Profile</h4>

                
              </div>
                <div class="card-body">
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
                {{-- <div class="col-6 col-sm-3 col-lg-3 mb-4 mb-md-0">
                  <div class="avatar-item">
                    <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png')}}" class="img-fluid" data-toggle="tooltip" title="">
                    <input type="file" name="gambar"><i class="fas fa-pencil-alt"></i>
                    <div class="avatar-badge" title="" data-toggle="tooltip" >
                    
                    </div>
                  </div>
                </div> --}}
                <form action="{{route ('update-user', Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                    <div class="row">
                      <div class="form-group col-md-6 col-12">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name"
                        @if (old('name'))
                        value="{{old('name')}}" 
                        @else
                        value="{{$user->name}}" 
                        @endif
                        >

                        <label 
                            @error('name') 
                            class="text-danger"
                            @enderror>
                            @error('name')
                            {{$message}}
                            @enderror
                          </label>

                      </div>

                    </div> 
                    <div class="row">
                      <div class="form-group col-md-6 col-6">
                        
                        <label>Email</label>
                        <div class="input-group mb-2 mr-sm-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">@</div>
                          </div>
                          <input type="email" class="form-control" name="email"
                         @if (old('email'))
                        value="{{old('email')}}" 
                        @else
                        value="{{$user->email}}" 
                        @endif
                        >
                        </div>
                        
                        

                        <label 
                            @error('email') 
                            class="text-danger"
                            @enderror>
                            @error('email')
                            {{$message}}
                            @enderror
                          </label>

                      </div>

                      {{-- <div class="form-group col-md-6 col-6" >
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Kosongi password jika tidak diubah." name="password-baru">
                      </div> --}}
                      <div class="form-group col-md-6 col-6"  >
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Kosongi password jika tidak diubah." name="password"
                        {{-- @if (old('password'))
                        value="{{old('password')}}" 
                        @else
                         value="{{$user->password}}"
                        @endif --}}
                        >
                      </div>
                      </div>
                      <div class="row">
                      <div class="form-group col-md-5 col-12">
                        <label>Role</label>
                        <input type="text" class="form-control" name="role"
                        @if (old('role'))
                        value="{{old('role')}}" 
                        @else
                        value="{{$user->role}}" 
                        @endif
                        disabled>
                      </div>
                      <div class="form-group col-md-5 col-12" hidden>
                        <label>Role</label>
                        <input type="text" class="form-control" name="role"
                        @if (old('role'))
                        value="{{old('role')}}" 
                        @else
                        value="{{$user->role}}" 
                        @endif
                        >
                        
                      </div>
                    </div>
                  </div>

                    
                    
                    <div class="card-footer text-left">
                      <a href="{{route('dashboard')}}" class="btn btn-primary">Back</a>
                      <button class="btn btn-info" type="submit">Simpan</button>
                    </form>
                    </div>
                  </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  
@stop



@push('scripts')

@endpush