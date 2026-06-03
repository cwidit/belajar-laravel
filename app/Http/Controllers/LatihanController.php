<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LatihanController extends Controller
{

public function index (){
//laravel:index akan di muat/load di awal
return view('latihan');
}

public function tambah(){
    $jumlah = 0;
    $title = 'Penjumlahan';
    return view('tambah', compact('jumlah','title'));
}
public function actionTambah(Request $request){
    $angka1 = $request->angka_1;
    $angka2 = $request->input('angka_2');

    $jumlah = $angka1 + $angka2;
    return view('tambah', compact('jumlah'));
}

public function kurang(){
     $jumlah = 0;
     $title = 'Pengurangan';
    return view('kurang', compact('jumlah','title'));
}
public function actionKurang(Request $request){
    $angka1 = $request->angka_1;
    $angka2 = $request->input('angka_2');

    $jumlah = $angka1 - $angka2;
    return view('kurang', compact('jumlah'));
}
public function kali(){
    $jumlah = 0;
    $title = 'Perkalian';
    return view('kali',compact('jumlah','title'));
}
public function actionKali(Request $request){
    $angka1 = $request->angka_1;
    $angka2 = $request->input('angka_2');

    $jumlah = $angka1 * $angka2;
    return view('kali', compact('jumlah'));
}
public function bagi(){
    $jumlah = 0;
    $title = 'Pembagian';
    return view('bagi',compact('jumlah','title'));
}
public function actionBagi(Request $request){
    $angka1 = $request->angka_1;
    $angka2 = $request->input('angka_2');

    $jumlah = $angka1 / $angka2;
    return view('bagi', compact('jumlah'));
}
}
