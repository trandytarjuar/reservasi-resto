<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapasitas extends Model
{
    protected $fillable = ['jumlah_orang'];

    protected $visible = ['id', 'jumlah_orang'];
}
