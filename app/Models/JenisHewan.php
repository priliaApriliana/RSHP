<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisHewan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'jenis_hewan';

    //primary key
    protected $primaryKey = 'idjenis_hewan';

    // Kolom yang bisa diisi
    protected $fillable = [
        'nama_jenis_hewan'
    ];

    // kalau tabel tidak punya kolom created_at & updated_at
    public $timestamps = false;
}
