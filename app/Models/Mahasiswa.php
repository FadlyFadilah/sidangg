<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Mahasiswa extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const PRODI_SELECT = [
        'statistika' => 'Statistika',
        'matematika' => 'Matematika',
        'farmasi'    => 'Farmasi',
    ];

    public $table = 'mahasiswas';

    protected $dates = [
        'ttl',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'prodi',
        'judul',
        'tempat_lahir',
        'ttl',
        'alamat',
        'no_hp',
        'asal_sekolah',
        'medsos',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function mahasiswaUser()
    {
        $query = "SELECT
                        *
                    FROM users
                    JOIN role_user ON users.id = role_user.user_id
                    JOIN roles ON roles.id = role_user.role_id
                    WHERE roles.title = 'User'";
        return DB::select($query);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function mahasiswaOrangtuas()
    {
        return $this->hasMany(Orangtua::class, 'mahasiswa_id', 'id');
    }

    public function syarats()
    {
        return $this->hasMany(Syarat::class, 'mahasiswa_id', 'id');
    }

    public function mahasiswaNilais()
    {
        return $this->hasMany(Nilai::class, 'mahasiswa_id', 'id');
    }

    public function getTtlAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTtlAttribute($value)
    {
        $this->attributes['ttl'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function userpembimbing()
    {
        return $this->belongsToMany(User::class, 'mahasiswa_user', 'mahasiswa_id', 'user_id');
    }
    public function userpenguji()
    {
        return $this->belongsToMany(User::class, 'penguji', 'mahasiswa_id', 'user_id');
    }
}