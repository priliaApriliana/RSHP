<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'kategori';

    // Primary key (jika bukan 'id')
    protected $primaryKey = 'idkategori';

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'nama_kategori'
    ];

    // Jika tabelmu tidak punya kolom created_at / updated_at
    public $timestamps = false;
}
