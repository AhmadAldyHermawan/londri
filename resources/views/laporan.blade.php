<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Laporan</title>
      <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/components.css')}}">
  <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.css')}}">
  <link rel="stylesheet" href="{{asset('assets//css/laporan.css')}}">
</head>
<body onload="window.print()">

        <br>
        <br>
        <div class="col-lg-6 kotak">
        <div class="container">
            @foreach ($outlet as $outlets)
            <h1>{{$outlets->nama}}</h1>
            <p class="alamat"><span class="highlight">Alamat : </span>{{$outlets->alamat}}, <span class="highlight">Telp : </span>{{$outlets->telp}}</p>
            @endforeach

<div class="row">
<div class="col-md-7">
<table class="table table-sm" border="1">
    <tr>
        <th>Nama Member</th>
        @foreach ($member as $members)
        <td>{{$members->nama_member}}</td>
        @endforeach
    </tr>
    <tr>
        <th>Tanggal Transaksi</th>
        <td>{{$transaksi->tgl}}</td>
    </tr>
    <tr>
        
        <th>Batas Waktu</th>
        <td>{{$transaksi->batas_waktu}}</td>
    </tr>
    <tr>
        <th>Tanggal Bayar</th>
        <td>{{$transaksi->tgl_bayar}}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>{{$transaksi->status}}</td>
    </tr>
    <tr>
        <th>Pembayaran</th>
        <td>{{$transaksi->dibayar}}</td>
    </tr>
   
</table>
<br>
<table class="table table-sm" border="1">

    <tr>
        <th>Jenis Paket</th>
        <th>Harga perkilo</th>
        <th>Jumlah Kg</th>
        <th>Total Bayar</th>
    </tr>
    <tr>
                 @foreach ($paket as $pakets)
    <td>{{$pakets->nama_paket}}</td>
    <td>Rp. {{$pakets->harga}}</td>
    @endforeach
    <td>{{$transaksi->qty}} Kg</td> 
    <td>Rp. {{$detail->subtotal}}</td>
    </tr>
</table>
</div>


<div class="col-md-5 peraturan">
    <ol type="1">
        <li>Pengambilan barang harus disertai nota</li>
        <li>Penyelesaian cucian maksimal 3 hari</li>
        <li>Barang yang tidak diambil selama 1 bulan, jika hilang bukan tanggung jawab kami</li>
        <li>Apabila terjadi kehilangan atau cacat karena kelalaian kami, kami hanya bertanggung jawab 2kali ongkos cuci</li>
    </ol>
</div>




</div>


<br>
<div class="row ttd">
<div class="col-md-3 mb-5">
    Hormat Kami,

</div>
<div class="col-md-6">

</div>
<div class="col-md-3 mb-5">
    Penerima,

</div>
</div>

<div class="row ttd">
<div class="col-md-3 mt-5">

    (.............................................)
</div>
<div class="col-md-6">

</div>
<div class="col-md-3 mt-5">

    (.............................................)
</div>

</div>

</div>
</div>
<br>
<center>
    <button id="cetak" class="btn btn-dark" onclick="window.print()">Cetak</button>
</center>
</body>
</html>