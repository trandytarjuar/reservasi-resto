<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMeja extends Model
{
    use HasFactory;
    protected $table = 'detail_meja';
    protected $fillable = ['id_meja', 'id_kapasitas'];
    protected $visible = ['id', 'id_meja', 'id_kapasitas'];

    protected $attributes = [
        'status' => 'avail', 
    ];

    public function meja()
    {
        return $this->belongsTo(Meja::class, 'id_meja');
    }

    public function kapasitas()
    {
        return $this->belongsTo(Kapasitas::class, 'id_kapasitas');
    }
}
