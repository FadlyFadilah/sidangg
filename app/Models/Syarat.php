<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syarat extends Model
{
    use HasFactory;

    public $table = 'syarats';

    protected $fillable = [
        'skripsi',    
        'skripsistatus' ,   
        'photo' ,   
        'photostatus' ,   
        'ppmb' ,   
        'ppmbstatus' ,    
        'serticalonsarjana' ,   
        'serticalonsarjanastatus' ,   
        'sertibebasperpus' ,   
        'sertibebasperpusstatus' ,   
        'sertimaba' ,   
        'sertimabastatus' ,   
        'bebaslab' ,   
        'bebaslabstatus' ,   
        'transkrip' ,   
        'transkripstatus' ,   
        'pembayaran' ,   
        'pembayaranstatus' ,  
        'status' ,   
        'feedback' ,   
        'mahasiswa_id' ,   
        'judul' ,   
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
