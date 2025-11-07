<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKlinis extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'kategori_klinis';

    // Primary key
    protected $primaryKey = 'idkategori_klinis';

    // Nonaktifkan timestamps (karena tabel tidak punya created_at & updated_at)
    public $timestamps = false;

    // Kolom yang dapat diisi
    protected $fillable = [
        'idkategori_klinis',
        'nama_kategori_klinis'
    ];


}
