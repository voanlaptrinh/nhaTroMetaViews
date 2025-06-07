<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tangs extends Model
{
    use HasFactory;
    protected $fillable = ['toa_nha_id', 'so_tang', 'ten_tang'];

    public function toaNha()
    {
        return $this->belongsTo(NhaTros::class);
    }

    public function phongs()
    {
        return $this->hasMany(Rooms::class);
    }
}
