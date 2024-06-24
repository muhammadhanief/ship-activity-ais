<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class masukKeluarIndoPerBulan extends Model
{
    use HasFactory;
    protected $table = 'masukKeluarIndoPerBulan';
    protected $fillable = ['Bulan', 'Pelabuhan', 'Masuk', 'Keluar', 'Kapal', 'Pendekatan'];
}
