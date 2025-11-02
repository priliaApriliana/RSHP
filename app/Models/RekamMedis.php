<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = null; //tidak ada updated_at

    protected $fillable = [
        'anamnesa',
        'temuan_klinis',
        'diagnosa',
        'idreservasi_dokter',
        'dokter_pemeriksa',
    ];

    //relasi ke temudokter
    public function temuDokter()
    {
        return $this->belongsTo(TemuDokter::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }

    //relasi ke pet(melalui temu_dokter)
    public function pet()
    {
        return $this->temuDokter->pet ?? null;
    }

    //relasi ke dokter pemeriksa 
    public function dokter()
    {
        return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa', 'idrole_user');
    }

    //relasi ke detail rekam medis 
    public function details()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }
}
