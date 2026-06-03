@extends('main')
@section('content')

<br><br>
<form action="{{ route('action-tambah') }}" method="post">
    @csrf
    <label for="">Angka 1</label>
    <input type="text" placeholder="Masukkan Angka" name="angka_1">
    +
    <label for="">Angka 2</label>
    <input type="text" placeholder="Masukkan Angka" name="angka_2">

<br>
<br>
<button type="submit">Proses</button>

</form>

<h3>Jumlahnya : {{ $jumlah }} </h3>

@endsection
