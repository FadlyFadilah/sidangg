<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orangtua extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const PEKERJAAN_AYAH_SELECT = [
        'asn'        => 'ASN',
        'swasta'     => 'Karyawan Swasta',
        'tni'        => 'TNI / Polri',
        'wiraswasta' => 'Wiraswasta',
        'lainnya'    => 'Lainnya',
    ];

    public const PEKERJAAN_IBU_SELECT = [
        'asn'        => 'ASN',
        'swasta'     => 'Karyawan Swasta',
        'tni'        => 'TNI / Polri',
        'wiraswasta' => 'Wiraswasta',
        'ibu_rt'     => 'Ibu Rumah Tangga',
        'lainnya'    => 'Lainnya',
    ];

    public $table = 'orangtuas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'mahasiswa_id',
        'nama_ibu',
        'pekerjaan_ibu',
        'nama_ayah',
        'pekerjaan_ayah',
        'alamat',
        'no_hp',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}