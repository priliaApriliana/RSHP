<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pet';

    // Primary key
    protected $primaryKey = 'idpet';

    // Tabel ini tidak punya kolom created_at dan updated_at
    public $timestamps = false;

    // Kolom yang bisa diisi
    protected $fillable = [
        'idpet',
        'nama',
        'tanggal_lahir',
        'warna_tanda',
        'jenis_kelamin',
        'idpemilik',
        'idras_hewan'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relasi Pet -> Pemilik (banyak hewan dimiliki satu pemilik)
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    // Relasi Pet -> Ras Hewan
    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    // Relasi Pet -> Temu Dokter (satu pet bisa beberapa kali daftar ke dokter)
    public function temuDokter()
    {
        return $this->hasMany(TemuDokter::class, 'idpet', 'idpet');
    }

    // Akses jenis hewan lewat ras_hewan
    public function jenisHewan()
    {
        return $this->hasOneThrough(
            JenisHewan::class,   // model tujuan akhir
            RasHewan::class,     // model perantara
            'idras_hewan',       // FK di ras_hewan (ke jenis_hewan)
            'idjenis_hewan',     // FK di jenis_hewan
            'idras_hewan',       // FK di pet
            'idjenis_hewan'      // PK di jenis_hewan
        );
    }
}
