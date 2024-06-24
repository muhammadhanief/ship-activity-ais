<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class masukKeluarIndoPerTipeKapal extends Model
{
    use HasFactory;
    protected $table = 'masukKeluarIndoPerTipeKapal';
    protected $fillable = ['Tipe Kapal', 'Pelabuhan', 'Masuk', 'Keluar', 'Kapal', 'Pendekatan'];
}
