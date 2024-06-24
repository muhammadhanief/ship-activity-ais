<?php

use App\Livewire\DurasiDiPelabuhan;
use App\Livewire\KapalIndonesia;
use App\Livewire\KunjunganKeLuarNegeri;
use App\Livewire\MasukKeluar;
use App\Livewire\PerairanIndonesia;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/perairan-indonesia', PerairanIndonesia::class)->name('perairan-indonesia');
Route::get('/kapal-indonesia', KapalIndonesia::class)->name('kapal-indonesia');
Route::get('/masuk-keluar', MasukKeluar::class)->name('masuk-keluar');
Route::get('/durasi-di-pelabuhan', DurasiDiPelabuhan::class)->name('durasi-di-pelabuhan');
Route::get('/kunjungan-ke-luar-negeri', KunjunganKeLuarNegeri::class)->name('kunjungan-ke-luar-negeri');
