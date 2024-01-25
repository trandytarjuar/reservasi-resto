<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $fillable = ['no_meja'];

    protected $visible = ['id', 'no_meja'];

    public function details()
    {
        return $this->hasMany(DetailMeja::class, 'id_meja');
    }
}
