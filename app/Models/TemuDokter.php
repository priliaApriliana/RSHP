<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    use HasFactory;

    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi_dokter';
    public $timestamps = false;

    protected $fillable = [
        'no_urut',
        'waktu_daftar',
        'status',
        'idpet',
        'idrole_user'
    ];

    protected $casts = [
        'waktu_daftar' => 'date',
    ];

    // relasi ke tabel pet
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    // relasi ke tabel role_user
    public function dokter()
    {
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }

    //relasi ke rekam medis 
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }
}
