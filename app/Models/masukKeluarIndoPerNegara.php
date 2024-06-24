<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class masukKeluarIndoPerNegara extends Model
{
    use HasFactory;
    protected $table = 'masukKeluarIndoPerNegara';
    protected $fillable = ['Pelabuhan', 'Negara_Asal', 'Masuk', 'Keluar', 'Pendekatan'];
}
