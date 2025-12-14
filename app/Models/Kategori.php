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
    
    // Jika tabelmu tidak punya kolom created_at / updated_at
    public $timestamps = false;
    public $incrementing = false; // karena idkategori TIDAK auto_increment

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'nama_kategori',
    ];

    public function kodeTindakanTerapi()
    {
        return $this->hasMany(KodeTindakanTerapi::class, 'idkategori', 'idkategori');
    }

}
