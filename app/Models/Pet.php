<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'pet';

    // Primary key
    protected $primaryKey = 'idpet';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'nama_pet',
        'idjenishewan',
        'umur',
        'jenis_kelamin',
        'berat',
        'idpemilik'
    ];

    // Jika tabel tidak memiliki kolom created_at & updated_at
    public $timestamps = false;

    // Relasi ke tabel Jenis Hewan
    public function jenisHewan()
    {
        return $this->belongsTo(JenisHewan::class, 'idjenishewan');
    }

    // Relasi ke tabel Pemilik
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik');
    }
}
