<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailMeja;
class ReservasiMeja extends Model
{
    use HasFactory;

    protected $table = 'reservasi_meja';

    protected $fillable = [
        'detail_id',
        'nama',
        'no_telp',
        'jumlah_orang',
        'tanggal_jam',
        'waktu_kedatangan',
    ];

    public function detail()
    {
        return $this->belongsTo(DetailMeja::class, 'detail_id');
    }
}
