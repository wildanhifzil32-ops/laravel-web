<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'Porofolio_1202';
    protected $fillable = [
        'nama_proyek',
        'kategori',
        'deskripsi',
        'klien_perusahaan',
        'link_proyek',
        'gambar_proyek',
    ];
}
